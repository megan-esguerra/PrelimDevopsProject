<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login(){
        return view('LogIn');
    }

    public function process()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('LogIn', [
                'validation' => $validation
            ]);
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getVar('email'))->first();

        if ($user && password_verify($this->request->getVar('password'), $user['password_hash'])) {
            $session = session();
            $session->set([
                'id' => $user['user_id'],
                'email' => $user['email'],
                'name' => $user['first_name'] . ' ' . $user['last_name'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            return view('LogIn', [
                'validation' => $validation->setError('password', 'Invalid email or password')
            ]);
        }
    }

    public function forgotPassword()
    {
        return view('forgot_password');
    }

    public function forgotPasswordProcess()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
    
        // If email doesn't exist in database
        if (!$user) {
            return redirect()->to('/forgot_password')->with('error', 'Email not found.');
        }
    
        // Generate a secure token (simple yet effective)
        $token = bin2hex(random_bytes(50)); // Random 100-character hex token
    
        // Expiration time (1 hour)
        $expiration = new \CodeIgniter\I18n\Time('+1 hour');
    
        // Update the user with the reset token and expiration time
        $userModel->update($user['user_id'], [
            'reset_token' => $token,
            'reset_token_expiration' => $expiration->toDateTimeString(),
        ]);
    
        // Send reset link to email
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Password Reset Request');
        $resetLink = site_url("Auth/resetPassword/{$token}");
        $emailService->setMessage("Click here to reset your password: <a href='{$resetLink}'>Reset Password</a>");
    
        // Debugging email sending process
        if ($emailService->send()) {
            log_message('info', 'Password reset email sent to ' . $email);
        } else {
            log_message('error', 'Failed to send email: ' . $emailService->printDebugger());
        }
    
        // Redirect to login with a success message
        return redirect()->to('/LogIn')->with('success', 'Password reset link sent to your email.');
    }

    public function resetPassword($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->to('LogIn')->with('error', 'Invalid or expired reset token.');
        }

        return view('reset_password', ['token' => $token]);
    }

    public function updatePassword($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->to('/LogIn')->with('error', 'Invalid or expired reset token.');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('reset_password', ['token' => $token, 'validation' => $validation]);
        }

        // Hash New Password
        $newPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $userModel->update($user['user_id'], ['password_hash' => $newPassword, 'reset_token' => null]);

        return redirect()->to('/LogIn')->with('success', 'Password updated successfully. Please log in.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/LogIn');
    }
}
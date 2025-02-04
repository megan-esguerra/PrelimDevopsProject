<?php

namespace App\Controllers;


use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Config\Services;

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

    // Process the Forgot Password
    public function forgotPasswordProcess()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
    
        // If email doesn't exist in the database
        if (!$user) {
            return redirect()->to('/forgot_password')->with('error', 'Email not found.');
        }
    
        // Generate a secure token
        $token = bin2hex(random_bytes(50)); // Random 100-character hex token
    
        // Expiration time (1 hour)
        $expiration = new Time('+1 hour');
    
        // Update the user with the reset token and expiration time
        $userModel->update($user['user_id'], [
            'reset_token' => $token,
            'reset_token_expiration' => $expiration->toDateTimeString(),
        ]);
    
        // Send reset link to email
        $emailService = Services::email();
        $emailService->setTo($email);
        $emailService->setFrom('0906megan64@gmail.com', 'Cat Cafes Inventory Management System');
        $emailService->setSubject('Password Reset Request');
        $resetLink = site_url("reset_password/{$token}");
        $emailService->setMessage("Click here to reset your password: <a href='{$resetLink}'>Reset Password</a>");
    
        // Send the email and check the result
        if ($emailService->send()) {
            log_message('info', 'Password reset email sent to: ' . $email);
        } else {
            log_message('error', 'Failed to send email: ' . $emailService->printDebugger());
            return redirect()->to('/forgot_password')->with('error', 'There was an error sending the reset email.');
        }
    
        // Redirect to login with a success message
        return redirect()->to('/LogIn')->with('success', 'Password reset link sent to your email.');
    }

    // Display the reset password form
    public function resetPassword($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        // If no user is found or the token has expired
        if (!$user || new Time() > new Time($user['reset_token_expiration'])) {
            return redirect()->to('/LogIn')->with('error', 'Invalid or expired reset token.');
        }

        return view('reset_password', ['token' => $token]);
    }

    // Process the password update
    public function updatePassword($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        // If no user is found or the token has expired
        if (!$user || new Time() > new Time($user['reset_token_expiration'])) {
            return redirect()->to('/LogIn')->with('error', 'Invalid or expired reset token.');
        }

        // Validate the new password
        $validation = \Config\Services::validation();
        $validation->setRules([
            'password_hash' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ]);

        // If validation fails, return to the reset password page with errors
        if (!$validation->withRequest($this->request)->run()) {
            return view('reset_password', ['token' => $token, 'validation' => $validation]);
        }

        // Hash the new password and save it
        $newPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $userModel->update($user['user_id'], [
            'password_hash' => $newPassword,
            'reset_token' => null, // Remove the reset token after resetting the password
            'reset_token_expiration' => null // Clear expiration time
        ]);

        // Redirect to login with a success message
        return redirect()->to('/LogIn')->with('success', 'Password updated successfully. Please log in.');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/LogIn');
    }
}
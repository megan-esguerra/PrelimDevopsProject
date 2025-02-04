<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Config\Services;

class Auth extends Controller
{
    // Show the login page
    public function login()
    {
        return view('LogIn');
    }

    // Handle the login form submission
    public function process()
    {
        $validation = \Config\Services::validation();

        // Define validation rules
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]'
        ]);

        // Validate input data
        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        // Get sanitized email and password
        $email = esc($this->request->getVar('email'));
        $password = $this->request->getVar('password');

        // Rate limiting logic (login attempts)
        $throttler = \Config\Services::throttler();
        if ($throttler->check(md5($this->request->getIPAddress()), 1, MINUTE) === false) {
            return redirect()->back()->with('error', 'Too many login attempts. Try again later.');
        }

        // Check the user credentials
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // Validate password
        if ($user && password_verify($password, $user['password_hash'])) {
            // Start a session if credentials are valid
            $session = session();
            $session->regenerate(true);
            $session->set([
                'id' => $user['user_id'],
                'email' => $user['email'],
                'name' => $user['first_name'] . ' ' . $user['last_name'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);

            // Role-based access check
            $userRole = $session->get('role');
            if (!in_array($userRole, ['admin', 'staff'])) {
                // If user is not admin or staff, redirect with error message
                return redirect()->to('/LogIn')->with('error', 'You do not have access to this page.');
            }

            // Redirect to dashboard on successful login
            return redirect()->to('/dashboard');
        } else {
            // Invalid login credentials, show login page with error
            return view('LogIn', [
                'validation' => $validation->setError('password', 'Invalid email or password')
            ]);
        }
    }

    // Show forgot password page
    public function forgotPassword()
    {
        return view('forgot_password');
    }

    // Handle forgot password process
    public function forgotPasswordProcess()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // If email is not found, redirect with error
        if (!$user) {
            return redirect()->to('/forgot_password')->with('error', 'Email not found.');
        }

        // Generate a secure token and expiration time
        $token = bin2hex(random_bytes(50)); // Random 100-character hex token
        $expiration = new Time('+1 hour');

        // Update the user record with reset token and expiration
        $userModel->update($user['user_id'], [
            'reset_token' => $token,
            'reset_token_expiration' => $expiration->toDateTimeString(),
        ]);

        // Send reset link to email
        $emailService = Services::email();
        $emailService->setTo($email);
        $emailService->setFrom('your-email@example.com', 'Cat Cafes Inventory Management System');
        $emailService->setSubject('Password Reset Request');
        $resetLink = site_url("reset_password/{$token}");
        $emailService->setMessage("Click here to reset your password: <a href='{$resetLink}'>Reset Password</a>");

        if ($emailService->send()) {
            log_message('info', 'Password reset email sent to: ' . $email);
        } else {
            log_message('error', 'Failed to send email: ' . $emailService->printDebugger());
            return redirect()->to('/forgot_password')->with('error', 'There was an error sending the reset email.');
        }

        // Success message, redirect to login
        return redirect()->to('/LogIn')->with('success', 'Password reset link sent to your email.');
    }

    // Show reset password page
    public function resetPassword($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        // Check if token is valid or expired
        if (!$user || new Time() > new Time($user['reset_token_expiration'])) {
            return redirect()->to('/login')->with('error', 'Invalid or expired reset token.');
        }

        return view('reset_password', ['token' => $token]);
    }

    // Process password update after reset
    public function updatePassword($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        // Validate the reset token
        if (!$user || new Time() > new Time($user['reset_token_expiration'])) {
            return redirect()->to('/LogIn')->with('error', 'Invalid or expired reset token.');
        }

        // Password validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ]);

        // If validation fails, return to reset password page
        if (!$validation->withRequest($this->request)->run()) {
            return view('reset_password', ['token' => $token, 'validation' => $validation]);
        }

        // Hash new password and update user record
        $newPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $userModel->update($user['user_id'], [
            'password_hash' => $newPassword,
            'reset_token' => null,
            'reset_token_expiration' => null
        ]);

        // Redirect to login with success message
        return redirect()->to('/LogIn')->with('success', 'Password updated successfully. Please log in.');
    }

    // Logout user
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/LogIn');
    }
}

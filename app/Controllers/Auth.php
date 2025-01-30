<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Load helper functions for form and URL
        helper(['form', 'url']);
        
        // Get the session instance
        $session = session();

        // Log the incoming POST data (email and password - but not the password for security reasons)
        log_message('debug', 'Login attempt with email: ' . $this->request->getVar('email'));

        // If the request method is POST (form submission)
        if ($this->request->getMethod() === 'post') {

            // Validation rules
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            // If validation fails, return to login view with validation errors
            if (!$this->validate($rules)) {
                // Log the validation errors
                log_message('debug', 'Login validation failed: ' . json_encode($this->validator->getErrors()));
                return view('LogIn', ['validation' => $this->validator]);
            }

            // Check the user credentials in the database
            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getVar('email'))->first();

            // Log the result of the user lookup
            if ($user) {
                log_message('debug', 'User found: ' . print_r($user, true));
            } else {
                log_message('debug', 'User not found for email: ' . $this->request->getVar('email'));
            }

            // If user exists and password is correct
            if ($user && password_verify($this->request->getVar('password'), $user['password_hash'])) {
                // Log that the password was verified successfully
                log_message('debug', 'Password verified for user: ' . $user['email']);

                // Set session data after successful login
                $session->set([
                    'user_id'   => $user['user_id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                ]);

                // Log session data
                log_message('debug', 'Session data set: ' . print_r($session->get(), true));

                // Redirect user based on their role
                switch ($user['role']) {
                    case 'admin':
                        log_message('debug', 'Redirecting admin to /admin/dashboard');
                        return redirect()->to('/admin/dashboard');
                    case 'staff':
                        log_message('debug', 'Redirecting staff to /staff/dashboard');
                        return redirect()->to('/staff/dashboard');
                    default:
                        log_message('debug', 'Redirecting user to /user/dashboard');
                        return redirect()->to('/user/dashboard');
                }

            } else {
                // If credentials don't match, return to login with an error message
                log_message('debug', 'Invalid email or password for user: ' . $this->request->getVar('email'));
                return redirect()->back()->with('error', 'Invalid email or password.');
            }
        }

        // If it's not a POST request, show the login page
        return view('LogIn');
    }

    public function logout()
    {
        // Log out the user and destroy the session
        log_message('debug', 'Logging out user: ' . session()->get('email'));

        // Destroy the session
        session()->destroy();

        // Redirect to the login page
        return redirect()->to('/login');
    }
}

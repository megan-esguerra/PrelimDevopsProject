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

        // If the request method is POST (form submission)
        if ($this->request->getMethod() === 'post') {

            // Validation rules
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            // If validation fails, return to login view with validation errors
            if (!$this->validate($rules)) {
                return view('LogIn', ['validation' => $this->validator]);
            }

            // Check the user credentials in the database
            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getVar('email'))->first();

            // If user exists and password is correct
            if ($user && password_verify($this->request->getVar('password'), $user['password_hash'])) {

                // Set session data after successful login
                $session->set([
                    'user_id'   => $user['user_id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                ]);

                // Redirect user based on their role
                switch ($user['role']) {
                    case 'admin':
                        return redirect()->to('Pages/Dashboard'); // Corrected path to admin dashboard
                    case 'staff':
                        return redirect()->to('/staff/dashboard'); // Redirect staff dashboard
                    default:
                        return redirect()->to('/user/dashboard'); // Default user redirect
                }

            } else {
                // If credentials don't match, return to login with an error message
                return redirect()->back()->with('error', 'Invalid email or password.');
            }
        }

        // If it's not a POST request, show the login page
        return view('LogIn');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/LogIn');
    }
}

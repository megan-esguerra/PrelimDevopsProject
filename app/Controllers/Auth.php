<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login(){
        return view('LogIn');
    }

    public function process()
    {
        // Load helpers for form and URL
        helper(['form', 'url']);
        $session = session();

        // If the request method is POST (form submission)
        if ($this->request->getMethod() === 'post') {
            // Validation rules
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            // If validation fails, return with errors
            if (!$this->validate($rules)) {
                return view('login', ['validation' => $this->validator]);
            }

            // Get user data from the database
            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getVar('email'))->first();

            // Verify user and password
            if ($user && password_verify($this->request->getVar('password'), $user['password_hash'])) {
                // Set session data after successful login
                $session->set([
                    'user_id'   => $user['id'],
                    'email'     => $user['email'],
                    'password_hash'     => $user['password_hash'],
                    'logged_in' => true,
                ]);

                // Redirect to the dashboard
                return redirect()->to('/dashboard');
            } else {
                // If credentials don't match, show error message
                return redirect()->back()->with('error', 'Invalid email or password.');
            }
        }

        // Show login page for GET request
        return view('LogIn');
    }


    // public function process()
    // {
    //     helper(['form', 'url']);
    //     $session = session();

    //     // If it's a POST request, validate the login form
    //     if ($this->request->getMethod() === 'post') {
    //         $rules = [
    //             'email'    => 'required|valid_email',
    //             'password' => 'required|min_length[8]',
    //         ];

    //         // If validation fails, return with errors
    //         if (!$this->validate($rules)) {
    //             return view('login', ['validation' => $this->validator]);
    //         }

    //         // Get user data from the database
    //         $userModel = new UserModel();
    //         $user = $userModel->where('email', $this->request->getVar('email'))->first();

    //         // Verify user and password
    //         if ($user && password_verify($this->request->getVar('password'), $user['password_hash'])) {
    //             // Set session data after successful login
    //             $session->set([
    //                 'user_id'   => $user['user_id'],
    //                 'name'      => $user['email'],  // You could store a name here if you want
    //                 'role'      => $user['role'],
    //                 'logged_in' => true,
    //             ]);

    //             // Redirect user based on role
    //             if ($user['role'] === 'admin') {
    //                 return redirect()->to('/admin/dashboard');
    //             } elseif ($user['role'] === 'user') {
    //                 return redirect()->to('/user/dashboard');
    //             }
    //         } else {
    //             // If credentials don't match, show error message
    //             return redirect()->back()->with('error', 'Invalid email or password.');
    //         }
    //     }

    //     // Show login page for GET request
    //     return view('login');
    // }

    // Logout function
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}

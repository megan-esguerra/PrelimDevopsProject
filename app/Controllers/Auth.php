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
         $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password_hash' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('LogIn', [
                'validation' => $validation
            ]);
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getVar('email'))->first();

        if ($user && password_verify($this->request->getVar('password_hash'), $user['password_hash'])) {
            $session = session();
            $session->set([
                'id' => $user['user_id'],
                'email' => $user['email'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            return view('LogIn', [
                'validation' => $validation->setError('password_hash', 'Invalid email or password')
            ]);
        }
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
        return redirect()->to('/LogIn');
    }
}

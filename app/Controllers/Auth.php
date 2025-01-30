<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        helper(['form', 'url']);
        $session = session();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            if (!$this->validate($rules)) {
                return view('login', ['validation' => $this->validator]);
            }

            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getVar('email'))->first();

            if ($user && password_verify($this->request->getVar('password'), $user['password_hash'])) {
                // Set user session
                $session->set([
                    'user_id'   => $user['user_id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                ]);

                // Redirect user based on role
                if ($user['role'] === 'admin') {
                    return redirect()->to('Pages/Dashboard'); // Redirect admin to dashboard
                } elseif ($user['role'] === 'staff') {
                    return redirect()->to('/staff/dashboard'); // Redirect staff
                } else {
                    return redirect()->to('Pages/Dashboards'); // Redirect normal users
                }
            } else {
                return redirect()->back()->with('error', 'Invalid email or password.');
            }
        }

        return view('LogIn');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/LogIn');
    }
}

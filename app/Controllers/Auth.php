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
            'password' => 'required'
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

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/LogIn');
    }
}
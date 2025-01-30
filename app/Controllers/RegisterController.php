<?php

namespace App\Controllers;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function store()
    {
        // Validate the input
        $validation = $this->validate([
            'first_name' => 'required|min_length[2]',
            'last_name' => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[8]',
            'password' => 'required|min_length[8]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return redirect()->to('/login')->with('success', 'Registration successful!');
    }
}

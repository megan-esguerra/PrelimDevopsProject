<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('Pages/users', ['users' => $users]);
    }
}
<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller {
    public function login(){
        helper(['form']);

        if($this->request->getMethod() === 'post'){
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            if(!$this->validate($rules)){
                return view('/login', ['validation' => $this->validator]);
            }

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($this->request->getVar('email'));

            if($user && password_verify($this->request->getVar('password'),$user['password_hash'])){
                $session = session();
                $session -> set([
                    'user_id' => $user['user_id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'logged_in' => true,
                ]);

                //Redirect based on role
                switch($user['role']){
                    case 'admin':
                        return redirect()->to('dashboard');
                    case 'staff':
                        return redirect()->to('');
                    default: 
                    return redirect()->to('/');
                }

            } else{
                return redirect()->back()->with('error', 'Invalid email or password.');
            }
        }

        return view('/login');
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}

?>
<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {$session = session();

        // Check if the user is logged in and has the 'admin' role
        if (!$session->has('role') || $session->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied. Admins only.');
        }
        
        return view('Pages/Dashboard');
        
    }
}

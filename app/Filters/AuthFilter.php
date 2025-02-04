<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        // Check if user is NOT logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/LogIn')->with('error', 'You must be logged in to access this page.');
        }

        

        // // Check if the user has the 'admin' or 'staff' role
        // $userRole = $session->get('role');
        // if (!in_array($userRole, ['admin', 'staff'])) {
        //     // If the user is not an admin or staff, redirect to the home page or a restricted access page
        //     return redirect()->to('/restricted')->with('error', 'You do not have permission to access this page.');
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the response is sent
    }
}

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/store', 'RegisterController::store');
$routes->post('/LogIn/login', 'Auth::login');
$routes->get('/LogIn', 'Auth::logout');
$routes->get('dashboard', 'DashboardController::index');




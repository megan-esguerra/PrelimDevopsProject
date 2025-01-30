<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/store', 'RegisterController::store');

$routes->get('/LogIn', 'Auth::login');
$routes->post('/LogIn/process', 'Auth::process');
$routes->get('/LogIn', 'Auth::logout');

$routes->get('dashboard', 'DashboardController::index');




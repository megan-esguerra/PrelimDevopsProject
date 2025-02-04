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

$routes->get('/forgot_password', 'Auth::forgotPassword');
$routes->post('/forgot_password', 'Auth::forgotPasswordProcess');
$routes->get('/reset_password/(:segment)', 'Auth::resetPassword/$1');
$routes->post('/reset_password/(:segment)', 'Auth::updatePassword/$1');


$routes->get('dashboard', 'DashboardController::index');
$routes->get('statistics', 'StatisticsController::index');
$routes->get('/orders', 'Orders::index');
$routes->get('/orders/new', 'Orders::newOrder');
$routes->get('/orders/filter', 'Orders::filterOrders');
$routes->get('/users', 'UsersController::index');
$routes->post('/orders/create', 'Orders::create');










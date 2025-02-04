<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes that require authentication
$routes->group('', ['filter' => 'role'], function ($routes) {
    // Protected routes that require user to be logged in
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('statistics', 'StatisticsController::index');
    $routes->get('/orders/filter', 'Orders::filterOrders');
    $routes->get('/users', 'UsersController::index');
    
    // Orders-related routes
    $routes->get('orders', 'Orders::index'); // View all orders
    $routes->post('orders/create', 'Orders::create'); // Create new order
    $routes->post('orders/update_status', 'Orders::update_status'); // Update order status
    $routes->post('orders/update', 'Orders::update'); // Update order details
    $routes->post('orders/delete', 'Orders::deleteOrder'); // Archive (soft delete) order
    $routes->post('orders/restore', 'Orders::restoreOrder'); // Restore archived order
    $routes->get('orders/get_archived', 'Orders::getArchivedOrders'); // Get archived orders

    // Inventory-related routes
    $routes->get('/in_stock', 'InStockController::index');         
    $routes->get('/new_stock', 'InStockController::addStock');   
    $routes->post('/save_stock', 'InStockController::saveStock');
});

// Routes that do not require authentication
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/store', 'RegisterController::store');

$routes->get('/LogIn', 'Auth::login');
$routes->post('/LogIn/process', 'Auth::process');
$routes->get('/logout', 'Auth::logout'); // Use /logout for logging out

$routes->get('/forgot_password', 'Auth::forgotPassword');
$routes->post('/forgot_password', 'Auth::forgotPasswordProcess');
$routes->get('/reset_password/(:segment)', 'Auth::resetPassword/$1');
$routes->post('/reset_password/(:segment)', 'Auth::updatePassword/$1');













<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/test', 'DatabaseTest::index');

$routes->get('admin/dashboard', 'Admin\DashboardController::index');

$routes->get('login', 'AuthController::login');

$routes->post('login', 'AuthController::authenticate');

$routes->get('logout', 'AuthController::logout');

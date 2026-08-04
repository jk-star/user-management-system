<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/test', 'DatabaseTest::index');

$routes->get('admin/dashboard', 'Admin\DashboardController::index');

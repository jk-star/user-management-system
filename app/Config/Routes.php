<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/test', 'DatabaseTest::index');

$routes->group(
    'admin',
    ['filter' => 'auth'],
    function ($routes) {

        $routes->get(
            'dashboard',
            'Admin\DashboardController::index'
        );

        $routes->get(
            'users',
            'Admin\UserController::index'
        );

        $routes->get(
            'users/create',
            'Admin\UserController::create'
        );

        $routes->post(
            'users/store',
            'Admin\UserController::store'
        );

        $routes->get(
            'users/(:num)',
            'Admin\UserController::show/$1'
        );

        $routes->get(
            'users/edit/(:num)',
            'Admin\UserController::edit/$1'
        );

        $routes->post(
            'users/update/(:num)',
            'Admin\UserController::update/$1'
        );

        $routes->post(
            'users/delete/(:num)',
            'Admin\UserController::delete/$1'
        );
    }
);

$routes->get('login', 'AuthController::login');

$routes->post('login', 'AuthController::authenticate');

$routes->get('logout', 'AuthController::logout');

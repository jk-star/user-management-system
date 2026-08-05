<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');

$routes->get('/test', 'DatabaseTest::index');

$routes->group(
    'admin',
    ['filter' => 'auth'],
    function ($routes) {

        // All logged-in users
        $routes->get(
            'dashboard',
            'Admin\DashboardController::index'
        );


        // Only Admin
        $routes->group(
            'users',
            ['filter' => 'admin'],
            function ($routes) {

                $routes->get(
                    '/',
                    'Admin\UserController::index'
                );

                $routes->get(
                    'create',
                    'Admin\UserController::create'
                );

                $routes->post(
                    'store',
                    'Admin\UserController::store'
                );

                $routes->get(
                    '(:num)',
                    'Admin\UserController::show/$1'
                );

                $routes->get(
                    'edit/(:num)',
                    'Admin\UserController::edit/$1'
                );

                $routes->post(
                    'update/(:num)',
                    'Admin\UserController::update/$1'
                );

                $routes->post(
                    'delete/(:num)',
                    'Admin\UserController::delete/$1'
                );
            }
        );
    }
);

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get(
        'profile',
        'ProfileController::index'
    );

    $routes->get(
        'profile/edit',
        'ProfileController::edit'
    );

    $routes->post(
        'profile/update',
        'ProfileController::update'
    );
});

$routes->get('/', 'AuthController::login');

$routes->post('login', 'AuthController::authenticate');

$routes->get('logout', 'AuthController::logout');

$routes->get('tutorial/(:segment)', 'TutorialController::chapter/$1');

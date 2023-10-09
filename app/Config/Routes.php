<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


 //auth
 $routes->post('auth/login', 'Auth\Auth::login');
 $routes->post('auth/register', 'Auth\Auth::register');
 $routes->get('auth/activated', 'Auth\Auth::activated');
$routes->post('auth/activated', 'Auth\Auth::activated');

 //public
$routes->get('/', 'Public\Dashboard::index');


//admin
$routes->group('admin', ['filter' => 'roleFilter'], function ($routes) {
//dashboard
$routes->get('dashboard', 'Admin\Dashboard::index');
// produk
$routes->get('produk/create', 'Admin\Produk\Create::index');
});

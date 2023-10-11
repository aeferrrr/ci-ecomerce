<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


 //auth
 $routes->post('auth/login', 'Auth\Auth::login');
 $routes->get('auth/logout', 'Auth\Auth::logout');
 $routes->post('auth/register', 'Auth\Auth::register');
 $routes->get('auth/activated', 'Auth\Auth::activated');
 $routes->post('auth/activated', 'Auth\Auth::activated');

//cart
$routes->get('/cart', 'Public\Cart::index');

//product
$routes->get('/detail/(:any)', 'Public\Product::index/$1');

 //public
 $routes->get('/beranda', 'Public\Dashboard::index');
$routes->get('/', 'Public\Dashboard::index');


//admin
$routes->group('admin', ['filter' => 'roleFilter'], function ($routes) {
//dashboard
$routes->get('dashboard', 'Admin\Dashboard::index');
// produk
$routes->get('produk/create', 'Admin\Produk\Create::index');
//kategori
$routes->match(['get', 'post'], 'kategori/create',    'Admin\Kategori\Create::index');
$routes->match(['get', 'post'], 'kategori/update/(:num)',    'Admin\Kategori\Update::index/$1');
$routes->get('kategori/read', 'Admin\Kategori\Read::index');
$routes->delete('kategori/delete/(:num)', 'Admin\Kategori\Delete::index/$1');
});

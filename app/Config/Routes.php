<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //public
$routes->get('/', 'Public\Dashboard::index');


//admin
$routes->group('admin', ['filter' => 'roleFilter'], function ($routes) {
//dashboard
$routes->get('dashboard', 'Admin\Dashboard::index');
// produk
$routes->get('produk/create', 'Admin\Produk\Create::index');
});

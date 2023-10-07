<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//dashboard
$routes->get('/dashboard', 'Admin\Dashboard::index');

// produk
$routes->get('/produk/create', 'Admin\Produk\Create::index');


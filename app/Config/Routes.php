<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Menu::index');
$routes->get('/menu', 'Menu::index');
// Auth Routes
$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::process');
$routes->get('/logout', 'Auth::logout');

// Public Pesanan (Pemesan)
$routes->get('/pesanan/create', 'Pesanan::create');
$routes->post('/pesanan/store', 'Pesanan::store');

// Protected Routes (Admin)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Menu CRUD (Admin only)
    $routes->get('/menu/create', 'Menu::create');
    $routes->post('/menu/store', 'Menu::store');
    $routes->get('/menu/edit/(:num)', 'Menu::edit/$1');
    $routes->put('/menu/update/(:num)', 'Menu::update/$1');
    $routes->delete('/menu/(:num)', 'Menu::delete/$1');

    // Laporan
    $routes->get('/laporan', 'Laporan::index');
    $routes->get('/laporan/pdf', 'Laporan::exportPdf');
    $routes->get('/laporan/excel', 'Laporan::exportExcel');

    // Riwayat Pesanan
    $routes->get('/pesanan/history', 'Pesanan::history');
    $routes->get('/pesanan/detail/(:num)', 'Pesanan::detail/$1');
});

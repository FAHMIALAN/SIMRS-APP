<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home route redirects to login
$routes->get('/', function() {
    return redirect()->to('/login');
});

// Auth Routes
$routes->get('/login', 'AuthController::login');
$routes->post('/login/process', 'AuthController::processLogin');
$routes->get('/register', 'AuthController::register');
$routes->post('/register/process', 'AuthController::processRegister');
$routes->get('/logout', 'AuthController::logout');

// User Routes
$routes->get('/user/dashboard', 'DashboardController::user');

// Admin Routes (Group)
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'DashboardController::admin');

    // Dokter
    $routes->get('dokter', 'DokterController::index');
    $routes->get('dokter/create', 'DokterController::create');
    $routes->post('dokter/store', 'DokterController::store');
    $routes->get('dokter/edit/(:num)', 'DokterController::edit/$1');
    $routes->post('dokter/update/(:num)', 'DokterController::update/$1');
    $routes->post('dokter/delete/(:num)', 'DokterController::delete/$1'); // Changed to POST for safety

    // Obat
    $routes->get('obat', 'ObatController::index');
    $routes->get('obat/create', 'ObatController::create');
    $routes->post('obat/store', 'ObatController::store');
    $routes->get('obat/edit/(:num)', 'ObatController::edit/$1');
    $routes->post('obat/update/(:num)', 'ObatController::update/$1');
    $routes->post('obat/delete/(:num)', 'ObatController::delete/$1');

    // Peresepan
    $routes->get('peresepan', 'PeresepanController::index');
    $routes->get('peresepan/create', 'PeresepanController::create');
    $routes->post('peresepan/store', 'PeresepanController::store');
    $routes->get('peresepan/show/(:num)', 'PeresepanController::show/$1');
    $routes->get('peresepan/report', 'PeresepanController::report');
});

// Pasien Routes (Existing)
$routes->get('/pasien', 'PasienController::index');
$routes->get('/pasien/create', 'PasienController::create');
$routes->post('/pasien/store', 'PasienController::store');
$routes->get('/pasien/edit/(:num)', 'PasienController::edit/$1');
$routes->post('/pasien/update/(:num)', 'PasienController::update/$1');
$routes->get('/pasien/delete/(:num)', 'PasienController::delete/$1');
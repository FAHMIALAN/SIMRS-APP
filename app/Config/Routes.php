<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// --- Public / Landing Page ---
$routes->get('/', 'LandingController::index');

// --- Authentication Routes ---
$routes->get('/login', 'AuthController::login');
$routes->post('/login/process', 'AuthController::processLogin');
$routes->get('/register', 'AuthController::register');
$routes->post('/register/process', 'AuthController::processRegister');
$routes->get('/logout', 'AuthController::logout');

// --- User / Patient Dashboard ---
$routes->get('/user/dashboard', 'DashboardController::user');
$routes->get('/user/peresepan/show/(:num)', 'DashboardController::userShowPeresepan/$1');

// --- Admin Module (Grouped) ---
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'DashboardController::admin');

    // Doctor Management
    $routes->get('dokter', 'DokterController::index');
    $routes->get('dokter/create', 'DokterController::create');
    $routes->post('dokter/store', 'DokterController::store');
    $routes->get('dokter/edit/(:num)', 'DokterController::edit/$1');
    $routes->post('dokter/update/(:num)', 'DokterController::update/$1');
    $routes->get('dokter/delete/(:num)', 'DokterController::delete/$1');

    // Medicine Management
    $routes->get('obat', 'ObatController::index');
    $routes->get('obat/create', 'ObatController::create');
    $routes->post('obat/store', 'ObatController::store');
    $routes->get('obat/edit/(:num)', 'ObatController::edit/$1');
    $routes->post('obat/update/(:num)', 'ObatController::update/$1');
    $routes->get('obat/delete/(:num)', 'ObatController::delete/$1');

    // Prescription & Billing
    $routes->get('peresepan', 'PeresepanController::index');
    $routes->get('peresepan/create', 'PeresepanController::create');
    $routes->post('peresepan/store', 'PeresepanController::store');
    $routes->get('peresepan/show/(:num)', 'PeresepanController::show/$1');
    $routes->get('peresepan/report', 'PeresepanController::report');

    // User & Staff Management
    $routes->get('user', 'UserController::index');
    $routes->get('user/create', 'UserController::create');
    $routes->post('user/store', 'UserController::store');
    $routes->get('user/edit/(:num)', 'UserController::edit/$1');
    $routes->post('user/update/(:num)', 'UserController::update/$1');
    $routes->get('user/delete/(:num)', 'UserController::delete/$1');
});

// --- Patient CRUD (Legacy/Additional) ---
$routes->get('/pasien', 'PasienController::index');
$routes->get('/pasien/create', 'PasienController::create');
$routes->post('/pasien/store', 'PasienController::store');
$routes->get('/pasien/edit/(:num)', 'PasienController::edit/$1');
$routes->post('/pasien/update/(:num)', 'PasienController::update/$1');
$routes->get('/pasien/delete/(:num)', 'PasienController::delete/$1');
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Variabel Filter
$authFilter = ['filter' => 'auth'];

// Variabel Role
$admin     = ['filter' => 'role:admin'];
$teknisi     = ['filter' => 'role:teknisi'];
$pelapor     = ['filter' => 'role:pelapor'];
$allRole   = ['filter' => 'role:admin, teknisi, pelapor'];

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Halaman utama
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Dashboard::index', $authFilter);

$routes->get('/users/create', 'Users::create'); // form tambah user
$routes->post('/users/store', 'Users::store'); // aksi simpan user

$routes->get('/users', 'Users::index', $allRole); // menampilkan data user
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $allRole); // form edit user
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole); // aksi update user
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole); // aksi hapus user

$routes->get('users/detail/(:num)', 'Users::detail/$1', $allRole); // aksi detail user
$routes->get('users/print', 'Users::print', $allRole); // aksi print data user
$routes->get('users/wa/(:num)', 'Users::wa/$1', $allRole); // aksi kirim ke whatsapp

// USERS
$routes->get('/users', 'Users::index');
$routes->get('/users/create', 'Users::create');
$routes->post('/users/store', 'Users::store');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update/(:num)', 'Users::update/$1');
$routes->get('/users/delete/(:num)', 'Users::delete/$1');
$routes->get('/users/search', 'Users::search');

// JENIS PELAPOR
$routes->get('/jenis', 'JenisPelapor::index');
$routes->get('/jenis/create', 'JenisPelapor::create');
$routes->post('/jenis/store', 'JenisPelapor::store');
$routes->get('/jenis/edit/(:num)', 'JenisPelapor::edit/$1');
$routes->post('/jenis/update/(:num)', 'JenisPelapor::update/$1');
$routes->get('/jenis/delete/(:num)', 'JenisPelapor::delete/$1');

// PENGADUAN
$routes->get('/pengaduan', 'Pengaduan::index');
$routes->get('/pengaduan/create', 'Pengaduan::create');
$routes->post('/pengaduan/store', 'Pengaduan::store');
$routes->get('/pengaduan/edit/(:num)', 'Pengaduan::edit/$1');
$routes->post('/pengaduan/update/(:num)', 'Pengaduan::update/$1');
$routes->get('/pengaduan/delete/(:num)', 'Pengaduan::delete/$1');
$routes->get('/pengaduan/detail/(:num)', 'Pengaduan::detail/$1');
$routes->get('/pengaduan/tolak/(:num)', 'Pengaduan::tolakForm/$1');
$routes->post('/pengaduan/tolak/(:num)', 'Pengaduan::tolak/$1');
$routes->get('/pengaduan/print', 'Pengaduan::print');

// TANGGAPAN
$routes->get('/tanggapan', 'Tanggapan::index');
$routes->get('/tanggapan/create/(:num)', 'Tanggapan::create/$1');
$routes->get('/penugasan/create', 'Penugasan::create');
$routes->post('/tanggapan/store', 'Tanggapan::store');
$routes->get('/tanggapan/edit/(:num)', 'Tanggapan::edit/$1');
$routes->post('/tanggapan/update/(:num)', 'Tanggapan::update/$1');
$routes->get('/tanggapan/delete/(:num)', 'Tanggapan::delete/$1');
$routes->get('tanggapan/detail/(:num)', 'Tanggapan::detail/$1');
$routes->get('/tanggapan/print', 'Tanggapan::print');

// PENUGASAN
$routes->get('/penugasan', 'Penugasan::index');
$routes->get('/penugasan/create/(:num)', 'Penugasan::create/$1');
$routes->post('/penugasan/store', 'Penugasan::store');
$routes->get('/penugasan/edit/(:num)', 'Penugasan::edit/$1');
$routes->post('/penugasan/update/(:num)', 'Penugasan::update/$1');
$routes->get('/penugasan/print', 'Penugasan::print');
$routes->get('/penugasan/detail/(:num)', 'Penugasan::detail/$1');
$routes->get('/penugasan/delete/(:num)', 'Penugasan::delete/$1');

// NOTIFIKASI
$routes->get('/notifikasi', 'Notifikasi::index');
$routes->get('/notifikasi/read/(:num)', 'Notifikasi::read/$1');
$routes->get('/notifikasi/read-all', 'Notifikasi::readAll');


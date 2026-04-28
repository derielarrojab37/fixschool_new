<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- KONFIGURASI FILTER & ROLE ---
// Mendefinisikan variabel filter untuk mempermudah penulisan hak akses pada routes
$authFilter = ['filter' => 'auth'];
$admin      = ['filter' => 'role:admin'];
$teknisi    = ['filter' => 'role:teknisi'];
$pelapor    = ['filter' => 'role:pelapor'];
$allRole    = ['filter' => 'role:admin, teknisi, pelapor'];

// --- AUTENTIKASI ---
// Mengatur rute untuk proses masuk, keluar, dan validasi akun
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// --- HALAMAN UTAMA ---
// Rute untuk beranda dan dashboard utama setelah login
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Dashboard::index', $authFilter);

// --- MANAJEMEN PENGGUNA (USERS) ---
// Mengelola data akun pengguna, pendaftaran, pengeditan, hingga fitur WhatsApp
$routes->get('/users', 'Users::index', $allRole);
$routes->get('/users/create', 'Users::create');
$routes->post('/users/store', 'Users::store');
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $allRole);
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole);
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole);
$routes->get('/users/detail/(:num)', 'Users::detail/$1', $allRole);
$routes->get('/users/print', 'Users::print', $allRole);
//$routes->get('/users/wa/(:num)', 'Users::wa/$1', $allRole);
$routes->get('/users/search', 'Users::search');

// --- MASTER DATA: JENIS PELAPOR ---
// Mengelola kategori atau klasifikasi tipe pelapor
$routes->get('/jenis', 'JenisPelapor::index');
$routes->get('/jenis/create', 'JenisPelapor::create');
$routes->post('/jenis/store', 'JenisPelapor::store');
$routes->get('/jenis/edit/(:num)', 'JenisPelapor::edit/$1');
$routes->post('/jenis/update/(:num)', 'JenisPelapor::update/$1');
$routes->get('/jenis/delete/(:num)', 'JenisPelapor::delete/$1');

// --- MANAJEMEN PENGADUAN ---
// Inti sistem untuk mengelola input laporan, penolakan, dan cetak laporan
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

// --- MANAJEMEN TANGGAPAN ---
// Mengelola balasan atau respon teknis terhadap pengaduan yang masuk
$routes->get('/tanggapan', 'Tanggapan::index');
$routes->get('/tanggapan/create/(:num)', 'Tanggapan::create/$1');
$routes->post('/tanggapan/store', 'Tanggapan::store');
$routes->get('/tanggapan/edit/(:num)', 'Tanggapan::edit/$1');
$routes->post('/tanggapan/update/(:num)', 'Tanggapan::update/$1');
$routes->get('/tanggapan/delete/(:num)', 'Tanggapan::delete/$1');
$routes->get('tanggapan/detail/(:num)', 'Tanggapan::detail/$1');
$routes->get('/tanggapan/print', 'Tanggapan::print');

// --- MANAJEMEN PENUGASAN ---
// Mengatur instruksi kerja atau disposisi kepada teknisi di lapangan
$routes->get('/penugasan', 'Penugasan::index');
$routes->get('/penugasan/create/(:num)', 'Penugasan::create/$1');
$routes->get('/penugasan/create', 'Penugasan::create');
$routes->post('/penugasan/store', 'Penugasan::store');
$routes->get('/penugasan/edit/(:num)', 'Penugasan::edit/$1');
$routes->post('/penugasan/update/(:num)', 'Penugasan::update/$1');
$routes->get('/penugasan/print', 'Penugasan::print');
$routes->get('/penugasan/detail/(:num)', 'Penugasan::detail/$1');
$routes->get('/penugasan/delete/(:num)', 'Penugasan::delete/$1');

// --- SISTEM NOTIFIKASI ---
// Fitur pemberitahuan untuk pengguna mengenai update status laporan
$routes->get('/notifikasi', 'Notifikasi::index');
$routes->get('/notifikasi/read/(:num)', 'Notifikasi::read/$1');
$routes->get('/notifikasi/read-all', 'Notifikasi::readAll');
$routes->get('/notifikasi/clear', 'Notifikasi::clear');

// --- PEMELIHARAAN SISTEM: RESTORE DATABASE ---
// Fitur untuk mengembalikan data dari file cadangan (backup)
$routes->get('/restore', 'Restore::index');
$routes->post('/restore/auth', 'Restore::auth');
$routes->get('/restore/form', 'Restore::form');
$routes->post('/restore/process', 'Restore::process');

// --- PEMELIHARAAN SISTEM: BACKUP DATABASE ---
// Fitur untuk mencadangkan database sistem saat ini
$routes->get('/backup', 'Backup::index');

// --- PUSAT BANTUAN (SUPPORT) ---
// Saluran komunikasi bantuan teknis dan FAQ aplikasi
$routes->get('/support', 'Support::index');
$routes->get('/support/create', 'Support::create');
$routes->post('/support/store', 'Support::store');
$routes->get('/support/detail/(:num)', 'Support::detail/$1');
$routes->post('/support/reply/(:num)', 'Support::reply/$1');
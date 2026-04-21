<?php

namespace App\Controllers;

use App\Models\NotifikasiModel;
use App\Models\PengaduanModel;
use App\Models\UsersModel;

class Dashboard extends BaseController
{
    // Dashboard.php
public function index()
{
    // Pastikan user sudah login
    if (!session()->get('id_user')) {
        return redirect()->to('/login');
    }

    $notifModel = new NotifikasiModel();
    $db = \Config\Database::connect();

    $data = [
        // Ambil notif berdasarkan user yang login
        'notif'      => $notifModel->where('id_user', session()->get('id_user'))
                                   ->orderBy('tanggal', 'DESC')
                                   ->findAll(),
                                   
        'total_user' => $db->table('users')->countAllResults(),
        
        // Menggunakan countAllResults agar builder di-reset tiap query
        'selesai'    => $db->table('pengaduan')->where('status', 'selesai')->countAllResults(),
        'diproses'   => $db->table('pengaduan')->where('status', 'diproses')->countAllResults(),
        'ditolak'    => $db->table('pengaduan')->where('status', 'ditolak')->countAllResults(),
        'menunggu'   => $db->table('pengaduan')->where('status', 'menunggu')->countAllResults(),
    ];

    $db = db_connect();
$now = date('Y-m-d H:i:s');

// TERLAMBAT
$db->table('pengaduan')
    ->set('status_sla', 'terlambat')
    ->where('deadline <', $now)
    ->where('status !=', 'selesai')
    ->update();

// HAMPIR
$db->table('pengaduan')
    ->set('status_sla', 'hampir')
    ->where('deadline >=', $now)
    ->where('deadline <=', date('Y-m-d H:i:s', strtotime('+1 day')))
    ->update();

// AMAN
$db->table('pengaduan')
    ->set('status_sla', 'aman')
    ->where('deadline >', date('Y-m-d H:i:s', strtotime('+1 day')))
    ->update();

    $telat = $db->table('pengaduan')
    ->where('status_sla', 'terlambat')
    ->get()->getResultArray();

foreach ($telat as $t) {
    $db->table('notifikasi')->insert([
        'id_user' => 1,
        'pesan' => 'Pengaduan "' . $t['judul'] . '" melewati deadline!',
        'status' => 'belum',
        'tanggal' => date('Y-m-d H:i:s')
    ]);
}

    return view('layouts/dashboard', $data);
}
}
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

    return view('layouts/dashboard', $data);
}
}
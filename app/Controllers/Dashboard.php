<?php

namespace App\Controllers;

use App\Models\NotifikasiModel;
use App\Models\PengaduanModel;
use App\Models\UsersModel;

class Dashboard extends BaseController
{
    public function index()
{
    $notifModel = new NotifikasiModel();
    $db = db_connect();

    // 🔔 NOTIF
    $data['notif'] = $notifModel
        ->where('id_user', session()->get('id_user'))
        ->orderBy('tanggal','DESC')
        ->findAll();

    // 👥 USER
    $data['total_user'] = $db->table('users')->countAllResults();

    // 📊 PENGADUAN
    $data['selesai'] = $db->table('pengaduan')->where('status','selesai')->countAllResults();
    $data['diproses'] = $db->table('pengaduan')->where('status','diproses')->countAllResults();
    $data['ditolak'] = $db->table('pengaduan')->where('status','ditolak')->countAllResults();
    $data['menunggu'] = $db->table('pengaduan')->where('status','menunggu')->countAllResults();

    return view('layouts/dashboard', $data);
}
}
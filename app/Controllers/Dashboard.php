<?php

namespace App\Controllers;

use App\Models\NotifikasiModel;

class Dashboard extends BaseController
{
    public function index()
{
    $notifModel = new \App\Models\NotifikasiModel();

    // ambil semua notif
    $data['notif'] = $notifModel
        ->where('id_user', session()->get('id_user'))
        ->orderBy('tanggal','DESC')
        ->findAll();

    // hitung notif belum dibaca
    $data['jumlah_notif'] = $notifModel
        ->where('id_user', session()->get('id_user'))
        ->where('status','belum')
        ->countAllResults();
        
    $notifModel->where('id_user', session()->get('id_user'))
           ->where('status','belum')
           ->set(['status' => 'sudah'])
           ->update();
    return view('dashboard', $data);
}
}
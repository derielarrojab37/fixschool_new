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
        $userModel = new UsersModel();

        // 🔔 NOTIF
        $data['notif'] = $notifModel
            ->where('id_user', session()->get('id_user'))
            ->orderBy('tanggal','DESC')
            ->findAll();

        $data['jumlah_notif'] = $notifModel
            ->where('id_user', session()->get('id_user'))
            ->where('status','belum')
            ->countAllResults();

        // update notif jadi sudah
        $notifModel->where('id_user', session()->get('id_user'))
            ->where('status','belum')
            ->set(['status' => 'sudah'])
            ->update();

        // 👥 TOTAL USER
        $data['total_user'] = $userModel->countAll();

        // 📊 STATUS PENGADUAN (FIX)
        $data['selesai'] = (new PengaduanModel())->where('status','selesai')->countAllResults();
        $data['diproses'] = (new PengaduanModel())->where('status','diproses')->countAllResults();
        $data['ditolak'] = (new PengaduanModel())->where('status','ditolak')->countAllResults();
        $data['menunggu'] = (new PengaduanModel())->where('status','menunggu')->countAllResults();

        return view('layouts/dashboard', $data);
    }
}
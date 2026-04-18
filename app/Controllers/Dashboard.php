<?php

namespace App\Controllers;

use App\Models\NotifikasiModel;
use App\Models\PengaduanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $notifModel = new NotifikasiModel();
        $model = new PengaduanModel();

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


}
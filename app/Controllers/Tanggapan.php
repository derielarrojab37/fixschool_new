<?php

// Namespace controller (menentukan lokasi file dalam struktur CI4)
namespace App\Controllers;

// Menggunakan model TanggapanModel untuk interaksi database
use App\Models\TanggapanModel;

// Class Tanggapan mewarisi BaseController (class utama di CI4)
class Tanggapan extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new TanggapanModel();
    }

    public function store() {
        $this->model->save([
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
            'id_user' => session()->get('id_user'),
            'isi_tanggapan' => $this->request->getPost('isi')
        ]);

        return redirect()->back();
    }

    public function index()
{
    $model = new TanggapanModel();
    $data['tanggapan'] = $model->findAll();

    return view('tanggapan/index', $data);
}


}
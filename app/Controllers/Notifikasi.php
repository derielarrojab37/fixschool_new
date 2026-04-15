<?php

// Namespace controller (menentukan lokasi file dalam struktur CI4)
namespace App\Controllers;

// Menggunakan model NotifikasiModel untuk interaksi database
use App\Models\NotifikasiModel;

// Class Notifikasi mewarisi BaseController (class utama di CI4)
class Notifikasi extends BaseController
{



public function index()
{
    $model = new NotifikasiModel();

    $data['notifikasi'] = $model
        ->where('id_user', session()->get('id_user'))
        ->findAll();

    return view('notifikasi/index', $data);
}

}
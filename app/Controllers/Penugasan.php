<?php

// Namespace controller (menentukan lokasi file dalam struktur CI4)
namespace App\Controllers;

// Menggunakan model PenugasanModel untuk interaksi database
use App\Models\PenugasanModel;

// Class Penugasan mewarisi BaseController (class utama di CI4)
class Penugasan extends BaseController {

    public function assign() {
        $penugasanModel = new PenugasanModel();
        $notifModel = new NotifikasiModel();

        $penugasanModel->save([
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
            'id_tanggapan' => $this->request->getPost('id_tanggapan'),
            'id_teknisi' => $this->request->getPost('id_teknisi'),
            'status' => 'ditugaskan'
        ]);

        // NOTIF
        $notifModel->save([
            'id_user' => $this->request->getPost('id_teknisi'),
            'pesan' => 'Anda mendapat tugas baru',
            'status' => 'belum'
        ]);

        return redirect()->to('/penugasan');
    }

    public function update($id) {
        $file = $this->request->getFile('foto_bukti');
        $nama = $file->getRandomName();
        $file->move('uploads/', $nama);

        $this->model->update($id, [
            'status' => $this->request->getPost('status'),
            'foto_bukti' => $nama
        ]);

        return redirect()->back();
    }

    public function index()
{
    $model = new PenugasanModel();

    if(session()->get('role') == 'teknisi'){
        $data['penugasan'] = $model
            ->where('id_teknisi', session()->get('id_user'))
            ->findAll();
    } else {
        $data['penugasan'] = $model->findAll();
    }

    return view('penugasan/index', $data);
}

}
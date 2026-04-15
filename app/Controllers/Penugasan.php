<?php

namespace App\Controllers;

use App\Models\PenugasanModel;

class Penugasan extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PenugasanModel();
    }

    // 🔹 INDEX
    public function index()
    {
        $db = db_connect();

        if(session()->get('role') == 'teknisi'){
            // teknisi hanya lihat tugas dia
            $data['penugasan'] = $this->model
                ->select('penugasan.*, pengaduan.judul, users.nama')
                ->join('pengaduan', 'pengaduan.id_pengaduan = penugasan.id_pengaduan')
                ->join('users', 'users.id_user = penugasan.id_teknisi')
                ->where('id_teknisi', session()->get('id_user'))
                ->findAll();
        } else {
            // admin lihat semua
            $data['penugasan'] = $this->model
                ->select('penugasan.*, pengaduan.judul, users.nama')
                ->join('pengaduan', 'pengaduan.id_pengaduan = penugasan.id_pengaduan')
                ->join('users', 'users.id_user = penugasan.id_teknisi')
                ->findAll();
        }

        return view('penugasan/index', $data);
    }

    // 🔹 CREATE (dari pengaduan)
    public function create()
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/');
    }

    $db = db_connect();

    // ambil semua pengaduan
    $data['pengaduan'] = $db->table('pengaduan')->get()->getResultArray();

    // ambil semua teknisi
    $data['teknisi'] = $db->table('users')
        ->where('role', 'teknisi')
        ->get()->getResultArray();

    return view('penugasan/create', $data);
}

    // 🔹 STORE
    public function store()
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/');
    }

    $this->model->save([
        'id_pengaduan' => $this->request->getPost('id_pengaduan'),
        'id_teknisi' => $this->request->getPost('id_teknisi'),
        'tanggal_penugasan' => $this->request->getPost('tanggal_penugasan'),
        'status' => 'ditugaskan'
    ]);

    // update status pengaduan
    db_connect()->table('pengaduan')
        ->where('id_pengaduan', $this->request->getPost('id_pengaduan'))
        ->update(['status' => 'diproses']);

    return redirect()->to('/penugasan');
}


    // 🔹 EDIT (untuk teknisi update status)
    public function edit($id)
    {
        $data['penugasan'] = $this->model->find($id);

        return view('penugasan/edit', $data);
    }

    // 🔹 UPDATE
    public function update($id)
{
    $data = [
        'status' => $this->request->getPost('status')
    ];

    // ❗ HANYA ADMIN BOLEH UBAH TANGGAL
    if(session()->get('role') == 'admin'){
        $data['tanggal_penugasan'] = $this->request->getPost('tanggal_penugasan');
    }

    // upload bukti (teknisi)
    $file = $this->request->getFile('foto_bukti');

    if ($file && $file->isValid()) {
        $nama = $file->getRandomName();
        $file->move('uploads/bukti/', $nama);
        $data['foto_bukti'] = $nama;
    }

    $this->model->update($id, $data);

    return redirect()->to('/penugasan');
}
}
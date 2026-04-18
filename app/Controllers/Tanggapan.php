<?php

namespace App\Controllers;

use App\Models\TanggapanModel;

class Tanggapan extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TanggapanModel();
    }

    // 🔹 INDEX
    public function index()
{
    $keyword = $this->request->getGet('keyword');
    $tanggal = $this->request->getGet('tanggal');

    $builder = $this->model
        ->select('tanggapan.*, pengaduan.judul, users.nama')
        ->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan')
        ->join('users', 'users.id_user = tanggapan.id_user');

    if($keyword){
        $builder->like('isi_tanggapan', $keyword)
                ->orLike('pengaduan.judul', $keyword);
    }

    if($tanggal){
        $builder->where('DATE(tanggapan.tanggal)', $tanggal);
    }

    $data['tanggapan'] = $builder->findAll();

    return view('tanggapan/index', $data);
}

    // 🔹 CREATE
    public function create($id_pengaduan)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $db = db_connect();

        $data['pengaduan'] = $db->table('pengaduan')
            ->where('id_pengaduan', $id_pengaduan)
            ->get()->getRowArray();

        return view('tanggapan/create', $data);
    }

    // 🔹 STORE
    public function store()
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/');
    }

    $file = $this->request->getFile('foto');
    $namaFoto = null;

    if ($file && $file->isValid()) {
        $namaFoto = $file->getRandomName();
        $file->move('uploads/tanggapan/', $namaFoto);
    }

    $id_pengaduan = $this->request->getPost('id_pengaduan');

    // ✅ SIMPAN TANGGAPAN
    $this->model->save([
        'id_pengaduan' => $id_pengaduan,
        'id_user' => session()->get('id_user'),
        'isi_tanggapan' => $this->request->getPost('isi_tanggapan'),
        'foto' => $namaFoto
    ]);

    // 🔥 TAMBAHAN WAJIB: UPDATE STATUS PENGADUAN
    db_connect()->table('pengaduan')
        ->where('id_pengaduan', $id_pengaduan)
        ->update(['status' => 'diproses']);

        $id_pengaduan = $this->request->getPost('id_pengaduan');

// 🔥 AMBIL DATA PENGADUAN
$pengaduan = db_connect()->table('pengaduan')
    ->where('id_pengaduan', $id_pengaduan)
    ->get()->getRowArray();

// 🔔 KIRIM NOTIF KE PELAPOR
db_connect()->table('notifikasi')->insert([
    'id_user' => $this->request->getPost('id_user_pengaduan'), // pelapor
    'pesan' => 'Pengaduan Anda sedang diproses',
    'status' => 'belum'
]);

    return redirect()->to('/pengaduan/detail/' . $id_pengaduan);
}

    // 🔹 EDIT
    public function edit($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $data['tanggapan'] = $this->model->find($id);

        return view('tanggapan/edit', $data);
    }

    // 🔹 UPDATE
    public function update($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $this->model->update($id, [
            'isi_tanggapan' => $this->request->getPost('isi_tanggapan')
        ]);

        return redirect()->to('/tanggapan');
    }

    // 🔹 DELETE
    public function delete($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $this->model->delete($id);
        return redirect()->to('/tanggapan');
    }

    public function print()
{
    $model = new \App\Models\TanggapanModel();

    $data['tanggapan'] = $model
        ->select('tanggapan.*, pengaduan.judul, users.nama')
        ->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan')
        ->join('users', 'users.id_user = tanggapan.id_user')
        ->findAll();

    return view('tanggapan/print', $data);
}
public function detail($id)
{
    $data['tanggapan'] = $this->model->find($id);
    return view('tanggapan/detail', $data);
}
}
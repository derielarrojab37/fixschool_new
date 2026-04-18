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

    // ✅ ambil parameter search DI ATAS
    $pengaduan = $this->request->getGet('pengaduan');
    $teknisi   = $this->request->getGet('teknisi');
    $tanggal   = $this->request->getGet('tanggal');

    // ✅ buat builder dulu (INI KUNCI NYA)
    $builder = $this->model
        ->select('penugasan.*, pengaduan.judul, users.nama')
        ->join('pengaduan', 'pengaduan.id_pengaduan = penugasan.id_pengaduan')
        ->join('users', 'users.id_user = penugasan.id_teknisi');

    // 🔐 ROLE FILTER
    if(session()->get('role') == 'teknisi'){
        $builder->where('id_teknisi', session()->get('id_user'));
    }

    // 🔍 SEARCH FILTER (DITARUH SEBELUM findAll)
    if($pengaduan){
        $builder->like('pengaduan.judul', $pengaduan);
    }

    if($teknisi){
        $builder->where('penugasan.id_teknisi', $teknisi);
    }

    if($tanggal){
        $builder->where('DATE(penugasan.tanggal_penugasan)', $tanggal);
    }

    // ✅ EKSEKUSI DI AKHIR
    $data['penugasan'] = $builder->findAll();

    // dropdown teknisi
    $data['teknisiList'] = $db->table('users')
        ->where('role','teknisi')
        ->get()->getResultArray();

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

    $id_pengaduan = $this->request->getPost('id_pengaduan');
    $id_teknisi   = $this->request->getPost('id_teknisi');

    $this->model->save([
        'id_pengaduan' => $id_pengaduan,
        'id_teknisi' => $id_teknisi,
        'tanggal_penugasan' => $this->request->getPost('tanggal_penugasan'),
        'status' => 'ditugaskan'
    ]);

    // update status pengaduan
    db_connect()->table('pengaduan')
        ->where('id_pengaduan', $id_pengaduan)
        ->update(['status' => 'diproses']);

    // 🔔 NOTIF KE TEKNISI (cukup 1x, jangan dobel)
    db_connect()->table('notifikasi')->insert([
    'id_user' => $id_teknisi,
    'pesan' => 'Anda mendapatkan tugas baru',
    'status' => 'belum'
]);

    return redirect()->to('/penugasan');
}


    // 🔹 EDIT (untuk teknisi update status)
    public function edit($id)
    {
        $data['penugasan'] = $this->model->find($id);

        return view('penugasan/edit', $data);
    }

    // deelete
    public function delete($id)
{
    // 🔐 hanya admin
    if(session()->get('role') != 'admin'){
        return redirect()->to('/penugasan')
            ->with('error','Tidak punya akses');
    }

    $data = $this->model->find($id);

    // ❌ tidak boleh hapus jika sudah selesai
    if($data['status'] == 'selesai'){
        return redirect()->to('/penugasan')
            ->with('error','Penugasan yang sudah selesai tidak boleh dihapus');
    }

    $this->model->delete($id);

    return redirect()->to('/penugasan')
        ->with('success','Penugasan berhasil dihapus');
}

    // 🔹 UPDATE
    public function update($id)
{
    $status = $this->request->getPost('status');

    $data = [
        'status' => $status
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

    // ✅ update penugasan
    $this->model->update($id, $data);

    // 🔥 TAMBAHAN PENTING (SINKRON STATUS)
    if($status == 'selesai'){
        $penugasan = $this->model->find($id);

        $db = db_connect();
        $db->table('pengaduan')
            ->where('id_pengaduan', $penugasan['id_pengaduan'])
            ->update(['status' => 'selesai']);
    }
    
    $id_teknisi = $this->request->getPost('id_teknisi');

    if($data['status'] == 'selesai'){

    // ambil data penugasan
    $penugasan = $this->model->find($id);

    // ambil pengaduan
    $pengaduan = db_connect()->table('pengaduan')
        ->where('id_pengaduan', $penugasan['id_pengaduan'])
        ->get()->getRowArray();

    // 🔔 NOTIF KE PELAPOR
    db_connect()->table('notifikasi')->insert([
    'id_user' => $pengaduan['id_user'],
    'pesan' => 'Pengaduan Anda telah selesai',
    'status' => 'belum'
]);
}

// 🔔 NOTIF KE ADMIN (status berubah)
$db = db_connect();

// ambil semua admin
$admin = $db->table('users')
    ->where('role', 'admin')
    ->get()
    ->getResultArray();

foreach($admin as $a){
    $db->table('notifikasi')->insert([
        'id_user' => $a['id_user'],
        'pesan' => 'Status penugasan diperbarui menjadi: '.$status,
        'status' => 'belum',
        'tanggal' => date('Y-m-d H:i:s')
    ]);
}

    return redirect()->to('/penugasan');
}

public function print()
{
    $data['penugasan'] = $this->model
        ->select('penugasan.*, pengaduan.judul, users.nama')
        ->join('pengaduan', 'pengaduan.id_pengaduan = penugasan.id_pengaduan')
        ->join('users', 'users.id_user = penugasan.id_teknisi')
        ->findAll();

    return view('penugasan/print', $data);
}

public function detail($id)
{
    $data['penugasan'] = $this->model
        ->select('penugasan.*, pengaduan.judul, users.nama')
        ->join('pengaduan', 'pengaduan.id_pengaduan = penugasan.id_pengaduan')
        ->join('users', 'users.id_user = penugasan.id_teknisi')
        ->where('id_penugasan', $id)
        ->first();

    return view('penugasan/detail', $data);
}
}
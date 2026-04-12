<?php

// Namespace controller (menentukan lokasi file dalam struktur CI4)
namespace App\Controllers;

// Menggunakan model UsersModel untuk interaksi database
use App\Models\PengaduanModel;

// Class Users mewarisi BaseController (class utama di CI4)
class Pengaduan extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new PengaduanModel();
    }

    public function index()
{
    $data['pengaduan'] = $this->model
        ->select('pengaduan.*, users.nama')
        ->join('users', 'users.id_user = pengaduan.id_user')
        ->findAll();

    return view('pengaduan/index', $data);
}

    public function create()
    {
    // CEK ROLE
    if (session()->get('role') != 'pelapor') {
        return redirect()->to('/pengaduan')->with('error', 'Akses ditolak!');
    }

    $db = db_connect();
    $data['jenis'] = $db->table('jenis_pelapor')->get()->getResultArray();

    return view('pengaduan/create', $data);
    }

    public function store()
{
    if (session()->get('role') != 'pelapor') {
        return redirect()->to('/pengaduan')->with('error', 'Akses ditolak!');
    }

    $file = $this->request->getFile('foto');
    $namaFoto = null;

    if ($file && $file->isValid()) {
        $namaFoto = $file->getRandomName();
        $file->move('uploads/pengaduan/', $namaFoto);
    }

    $this->model->save([
        'id_user' => session()->get('id_user'),
        'id_jenis' => $this->request->getPost('id_jenis'),
        'judul' => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'lokasi' => $this->request->getPost('lokasi'),
        'foto' => $namaFoto,
        'status' => 'menunggu'
    ]);

    return redirect()->to('/pengaduan')->with('success', 'Pengaduan berhasil dikirim');
}

    public function edit($id) {
        $data['pengaduan'] = $this->model->find($id);

        if ($data['pengaduan']['status'] != 'menunggu') {
            return redirect()->back()->with('error','Tidak bisa edit');
        }

        return view('pengaduan/edit', $data);
    }

    public function update($id) {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/pengaduan');
    }

    public function delete($id) {
        $this->model->delete($id);
        return redirect()->to('/pengaduan');
    }

    public function detail($id)
{
    // Ambil pengaduan + relasi
    $data['pengaduan'] = $this->model
        ->select('pengaduan.*, users.nama, jenis_pelapor.nama_jenis')
        ->join('users', 'users.id_user = pengaduan.id_user')
        ->join('jenis_pelapor', 'jenis_pelapor.id_jenis = pengaduan.id_jenis')
        ->where('id_pengaduan', $id)
        ->first();

    // Ambil tanggapan
    $db = db_connect();
    $data['tanggapan'] = $db->table('tanggapan')
        ->select('tanggapan.*, users.nama')
        ->join('users', 'users.id_user = tanggapan.id_user')
        ->where('id_pengaduan', $id)
        ->get()
        ->getResultArray();

    return view('pengaduan/detail', $data);
}
}
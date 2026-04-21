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
    $keyword = $this->request->getGet('keyword');
    $jenis   = $this->request->getGet('jenis');
    $tanggal = $this->request->getGet('tanggal');

    $builder = $this->model
        ->select('pengaduan.*, users.nama, jenis_pelapor.nama_jenis')
        ->join('users', 'users.id_user = pengaduan.id_user')
        ->join('jenis_pelapor', 'jenis_pelapor.id_jenis = pengaduan.id_jenis');

    // 🔐 ROLE FILTER
    if(session()->get('role') == 'pelapor'){
        $builder->where('pengaduan.id_user', session()->get('id_user'));
    }

    // 🔍 SEARCH FILTER
    if($keyword){
        $builder->like('judul', $keyword);
    }

    if($jenis){
        $builder->where('pengaduan.id_jenis', $jenis);
    }

    if($tanggal){
        $builder->where('DATE(tanggal)', $tanggal);
    }

    $data['pengaduan'] = $builder->findAll();

    // ambil jenis pelapor untuk dropdown
    $data['jenis'] = db_connect()->table('jenis_pelapor')->get()->getResultArray();

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

    // 🔔 NOTIF KE ADMIN
    $db = db_connect();
    $admin = $db->table('users')
        ->where('role', 'admin')
        ->get()
        ->getResultArray();

    foreach($admin as $a){
        $db->table('notifikasi')->insert([
            'id_user' => $a['id_user'],
            'pesan' => 'Pengaduan baru telah dibuat',
            'status' => 'belum',
            'tanggal' => date('Y-m-d H:i:s')
        ]);

        $kategori = $this->request->getPost('kategori');

//
$kategori = $this->request->getPost('kategori');

// hitung deadline
if ($kategori == 'ringan') {
    $deadline = date('Y-m-d H:i:s', strtotime('+2 days'));
} else {
    $deadline = date('Y-m-d H:i:s', strtotime('+7 days'));
}

$this->model->save([
    'judul' => $this->request->getPost('judul'),
    'kategori' => $kategori,
    'deadline' => $deadline,
    'status' => 'menunggu',
    'status_sla' => 'aman'
]);
}
    }

    return redirect()->to('/pengaduan')
        ->with('success', 'Pengaduan berhasil dikirim');
} // ✅ WAJIB ADA INI (penutup function)

    public function edit($id)
{
    $pengaduan = $this->model->find($id);

    // ambil tanggapan (validasi)
    $db = db_connect();
    $tanggapan = $db->table('tanggapan')
        ->where('id_pengaduan', $id)
        ->get()
        ->getResultArray();

    // VALIDASI (seperti sebelumnya)
    if (
        session()->get('role') != 'pelapor' ||
        $pengaduan['status'] != 'menunggu' ||
        !empty($tanggapan)
    ) {
        return redirect()->to('/pengaduan')->with('error', 'Tidak bisa mengubah pengaduan');
    }

    // 🔥 TAMBAHAN INI (PENTING)
    $data['jenis'] = $db->table('jenis_pelapor')->get()->getResultArray();

    $data['pengaduan'] = $pengaduan;

    return view('pengaduan/edit', $data);
}

    public function update($id) {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/pengaduan');
    }

    public function delete($id)
{
    // 🔐 hanya admin
    if(session()->get('role') != 'admin'){
        return redirect()->to('/pengaduan')
            ->with('error','Tidak punya akses');
    }

    $data = $this->model->find($id);

    // ❌ JIKA SUDAH SELESAI → TOLAK HAPUS
    if($data['status'] == 'selesai'){
        return redirect()->to('/pengaduan')
            ->with('error','Data yang sudah selesai tidak boleh dihapus');
    }

    // ❗ OPTIONAL: kalau masih ada penugasan
    $cek = db_connect()->table('penugasan')
        ->where('id_pengaduan', $id)
        ->countAllResults();

    if($cek > 0){
        return redirect()->to('/pengaduan')
            ->with('error','Data masih memiliki penugasan');
    }

    $this->model->delete($id);

    return redirect()->to('/pengaduan')
        ->with('success','Data berhasil dihapus');
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

public function tolakForm($id)
{
    if(session()->get('role') != 'admin'){
        return redirect()->to('/pengaduan');
    }

    $data['pengaduan'] = $this->model->find($id);

    return view('pengaduan/tolak', $data);
}

public function tolak($id)
{
    // 🔥 ambil alasan dari form
    $alasan = $this->request->getPost('alasan');

    // update pengaduan
    $this->model->update($id, [
        'status' => 'ditolak',
        'alasan_ditolak' => $alasan
    ]);

    // ambil data pengaduan
    $pengaduan = db_connect()->table('pengaduan')
        ->where('id_pengaduan', $id)
        ->get()->getRowArray();

    // 🔔 kirim notifikasi
    $alasan = $this->request->getPost('alasan');

db_connect()->table('notifikasi')->insert([
    'id_user' => $pengaduan['id_user'],
    'pesan' => 'Pengaduan ditolak: '.$alasan,
    'status' => 'belum'
]);

    return redirect()->to('/pengaduan/detail/'.$id);
}

public function print()
{
    $keyword = $this->request->getGet('keyword');
    $jenis   = $this->request->getGet('jenis');
    $tanggal = $this->request->getGet('tanggal');

    // 1. Inisialisasi Builder dari model
    $builder = $this->model->builder();

    // 2. Susun Query
    $builder->select('pengaduan.*, users.nama as nama_pelapor, jenis_pelapor.nama_jenis, tanggapan.isi_tanggapan');
    $builder->join('users', 'users.id_user = pengaduan.id_user');
    $builder->join('jenis_pelapor', 'jenis_pelapor.id_jenis = pengaduan.id_jenis');
    $builder->join('tanggapan', 'tanggapan.id_pengaduan = pengaduan.id_pengaduan', 'left'); // Ini cara nulis left join yang benar

    // 3. Filter (sama dengan di index)
    if ($keyword) {
        $builder->like('pengaduan.judul', $keyword);
    }
    if ($jenis) {
        $builder->where('pengaduan.id_jenis', $jenis);
    }
    if ($tanggal) {
        $builder->where('DATE(pengaduan.tanggal)', $tanggal);
    }

    // 4. Eksekusi
    $data['pengaduan'] = $builder->get()->getResultArray();

    return view('pengaduan/print', $data);
}
}
<?php

namespace App\Controllers;

use App\Models\PengaduanModel;

/**
 * Controller Pengaduan
 * Menangani seluruh alur pelaporan, validasi SLA, filter data, hingga cetak laporan.
 */
class Pengaduan extends BaseController {
    
    protected $model;

    /**
     * Constructor untuk inisialisasi PengaduanModel agar tersedia di seluruh method.
     */
    public function __construct() {
        $this->model = new PengaduanModel();
    }

    /**
     * Menampilkan daftar pengaduan dengan sistem filter keyword, jenis, tanggal, dan hak akses.
     */
    public function index()
    {
        // Mengambil input filter dari URL (metode GET)
        $keyword = $this->request->getGet('keyword');
        $jenis   = $this->request->getGet('jenis');
        $tanggal = $this->request->getGet('tanggal');

        // Menyiapkan Query Builder dengan join ke tabel users dan jenis_pelapor
        $builder = $this->model
            ->select('pengaduan.*, users.nama, jenis_pelapor.nama_jenis')
            ->join('users', 'users.id_user = pengaduan.id_user')
            ->join('jenis_pelapor', 'jenis_pelapor.id_jenis = pengaduan.id_jenis');

        // Filter Role: Jika login sebagai pelapor, hanya tampilkan data miliknya sendiri
        if(session()->get('role') == 'pelapor'){
            $builder->where('pengaduan.id_user', session()->get('id_user'));
        }

        // Filter Pencarian: Mencari berdasarkan judul pengaduan
        if($keyword){
            $builder->like('judul', $keyword);
        }

        // Filter Kategori: Mencari berdasarkan jenis pelapor tertentu
        if($jenis){
            $builder->where('pengaduan.id_jenis', $jenis);
        }

        // Filter Waktu: Mencari berdasarkan tanggal laporan dibuat
        if($tanggal){
            $builder->where('DATE(tanggal)', $tanggal);
        }

        $data['pengaduan'] = $builder->findAll();

        // Mengambil data master jenis pelapor untuk kebutuhan dropdown di view
        $data['jenis'] = db_connect()->table('jenis_pelapor')->get()->getResultArray();

        return view('pengaduan/index', $data);
    }

    /**
     * Menampilkan form input pengaduan baru khusus untuk role pelapor.
     */
    public function create()
    {
        // Validasi hak akses: Hanya pelapor yang boleh membuat pengaduan
        if (session()->get('role') != 'pelapor') {
            return redirect()->to('/pengaduan')->with('error', 'Akses ditolak!');
        }

        $db = db_connect();
        $data['jenis'] = $db->table('jenis_pelapor')->get()->getResultArray();

        return view('pengaduan/create', $data);
    }

    /**
     * Memproses penyimpanan data pengaduan baru serta menghitung deadline (SLA).
     */
    public function store()
    {
        // Proteksi keamanan role pelapor
        if (session()->get('role') != 'pelapor') {
            return redirect()->to('/pengaduan')->with('error', 'Akses ditolak!');
        }

        // Penanganan upload file foto pengaduan
        $file = $this->request->getFile('foto');
        $namaFoto = null;

        if ($file && $file->isValid()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/pengaduan/', $namaFoto);
        }

        // Logika SLA: Menentukan batas waktu penanganan berdasarkan kategori laporan
        $kategori = $this->request->getPost('kategori');

        if ($kategori == 'ringan') {
            $deadline = date('Y-m-d H:i:s', strtotime('+2 days'));
        } else {
            $deadline = date('Y-m-d H:i:s', strtotime('+7 days'));
        }

        // Menyimpan data utama pengaduan ke database
        $this->model->save([
            'id_user'    => session()->get('id_user'),
            'id_jenis'   => $this->request->getPost('id_jenis'),
            'judul'      => $this->request->getPost('judul'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'lokasi'     => $this->request->getPost('lokasi'),
            'foto'       => $namaFoto,
            'status'     => 'menunggu',
            'kategori'   => $kategori,
            'deadline'   => $deadline,
            'status_sla' => 'aman'
        ]);

        // Mengirim notifikasi otomatis kepada semua user dengan role admin
        $db = db_connect();
        $admin = $db->table('users')
            ->where('role', 'admin')
            ->get()
            ->getResultArray();

        foreach($admin as $a){
            $db->table('notifikasi')->insert([
                'id_user' => $a['id_user'],
                'pesan'   => 'Pengaduan baru telah dibuat',
                'status'  => 'belum',
                'tanggal' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to('/pengaduan')->with('success', 'Pengaduan berhasil dikirim');
    }

    /**
     * Menampilkan form edit pengaduan selama status masih 'menunggu' dan belum ada tanggapan.
     */
    public function edit($id)
    {
        $pengaduan = $this->model->find($id);

        // Memeriksa apakah pengaduan ini sudah memiliki tanggapan
        $db = db_connect();
        $tanggapan = $db->table('tanggapan')
            ->where('id_pengaduan', $id)
            ->get()
            ->getResultArray();

        // Validasi: Cegah edit jika bukan pelapor pemilik, status bukan menunggu, atau sudah ditanggapi
        if (
            session()->get('role') != 'pelapor' ||
            $pengaduan['status'] != 'menunggu' ||
            !empty($tanggapan)
        ) {
            return redirect()->to('/pengaduan')->with('error', 'Tidak bisa mengubah pengaduan');
        }

        $data['jenis'] = $db->table('jenis_pelapor')->get()->getResultArray();
        $data['pengaduan'] = $pengaduan;

        return view('pengaduan/edit', $data);
    }

    /**
     * Memproses pembaharuan data pengaduan yang sudah ada.
     */
    public function update($id) {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('/pengaduan');
    }

    /**
     * Menghapus data pengaduan beserta relasi penugasannya (khusus Admin).
     */
    public function delete($id)
    {
        // Validasi: Hanya Admin yang diizinkan menghapus data
        if(session()->get('role') != 'admin'){
            return redirect()->to('/pengaduan')->with('error','Tidak punya akses');
        }

        $data = $this->model->find($id);

        // Aturan: Data hanya boleh dihapus jika status akhirnya Selesai atau Ditolak
        if(!in_array($data['status'], ['selesai','ditolak'])){
            return redirect()->to('/pengaduan')->with('error','Data hanya bisa dihapus jika selesai atau ditolak');
        }

        // Menghapus relasi data di tabel penugasan terlebih dahulu untuk menjaga integritas database
        db_connect()->table('penugasan')->where('id_pengaduan', $id)->delete();

        $this->model->delete($id);

        return redirect()->to('/pengaduan')->with('success','Data berhasil dihapus');
    }

    /**
     * Menampilkan rincian lengkap pengaduan termasuk riwayat tanggapannya.
     */
    public function detail($id)
    {
        // Mengambil data detail pengaduan dengan join tabel terkait
        $data['pengaduan'] = $this->model
            ->select('pengaduan.*, users.nama, jenis_pelapor.nama_jenis')
            ->join('users', 'users.id_user = pengaduan.id_user')
            ->join('jenis_pelapor', 'jenis_pelapor.id_jenis = pengaduan.id_jenis')
            ->where('id_pengaduan', $id)
            ->first();

        // Mengambil seluruh daftar tanggapan yang berkaitan dengan pengaduan ini
        $db = db_connect();
        $data['tanggapan'] = $db->table('tanggapan')
            ->select('tanggapan.*, users.nama')
            ->join('users', 'users.id_user = tanggapan.id_user')
            ->where('id_pengaduan', $id)
            ->get()
            ->getResultArray();

        return view('pengaduan/detail', $data);
    }

    /**
     * Menampilkan halaman formulir penolakan pengaduan bagi Admin.
     */
    public function tolakForm($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/pengaduan');
        }

        $data['pengaduan'] = $this->model->find($id);
        return view('pengaduan/tolak', $data);
    }

    /**
     * Memproses status penolakan pengaduan dan mengirimkan notifikasi alasan penolakan ke pelapor.
     */
    public function tolak($id)
    {
        $alasan = $this->request->getPost('alasan');

        // Memperbaharui status pengaduan menjadi ditolak beserta alasannya
        $this->model->update($id, [
            'status' => 'ditolak',
            'alasan_ditolak' => $alasan
        ]);

        $pengaduan = db_connect()->table('pengaduan')
            ->where('id_pengaduan', $id)
            ->get()->getRowArray();

        // Mengirimkan notifikasi ke user pelapor agar mereka mengetahui alasan penolakan
        db_connect()->table('notifikasi')->insert([
            'id_user' => $pengaduan['id_user'],
            'pesan'   => 'Pengaduan ditolak: '.$alasan,
            'status'  => 'belum'
        ]);

        return redirect()->to('/pengaduan/detail/'.$id);
    }

    /**
     * Menghasilkan data laporan pengaduan untuk kebutuhan cetak (Print).
     */
    public function print()
    {
        $keyword = $this->request->getGet('keyword');
        $jenis   = $this->request->getGet('jenis');
        $tanggal = $this->request->getGet('tanggal');

        $builder = $this->model->builder();

        // Query lengkap dengan Left Join ke tanggapan agar data pengaduan tetap muncul meski belum ada respon
        $builder->select('pengaduan.*, users.nama as nama_pelapor, jenis_pelapor.nama_jenis, tanggapan.isi_tanggapan');
        $builder->join('users', 'users.id_user = pengaduan.id_user');
        $builder->join('jenis_pelapor', 'jenis_pelapor.id_jenis = pengaduan.id_jenis');
        $builder->join('tanggapan', 'tanggapan.id_pengaduan = pengaduan.id_pengaduan', 'left');

        // Konsistensi filter antara halaman index dan halaman cetak
        if ($keyword) { $builder->like('pengaduan.judul', $keyword); }
        if ($jenis) { $builder->where('pengaduan.id_jenis', $jenis); }
        if ($tanggal) { $builder->where('DATE(pengaduan.tanggal)', $tanggal); }

        $data['pengaduan'] = $builder->get()->getResultArray();

        return view('pengaduan/print', $data);
    }
}
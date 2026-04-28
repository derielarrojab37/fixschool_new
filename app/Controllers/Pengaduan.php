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
    $keyword = $this->request->getGet('keyword');
    $jenis   = $this->request->getGet('jenis');
    $tanggal = $this->request->getGet('tanggal');

    $builder = $this->model
        ->select('pengaduan.*, users.nama, jenis_pelapor.nama_jenis')
        ->join('users', 'users.id_user = pengaduan.id_user')
        ->join('jenis_pelapor', 'jenis_pelapor.id_jenis = users.id_jenis', 'left');

    // Filter role
    if(session()->get('role') == 'pelapor'){
        $builder->where('pengaduan.id_user', session()->get('id_user'));
    }

    // Filter keyword
    if($keyword){
        $builder->like('pengaduan.judul', $keyword);
    }

    //  FILTER JENIS (INI YANG KAMU MAU)
    if($jenis){
        $builder->where('users.id_jenis', $jenis);
    }

    // Filter tanggal
    if($tanggal){
        $builder->where('DATE(pengaduan.tanggal)', $tanggal);
    }

    $data['pengaduan'] = $builder->findAll();

    // Dropdown tetap tampil
    $data['jenis'] = db_connect()
        ->table('jenis_pelapor')
        ->get()
        ->getResultArray();

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

        //$db = db_connect();
        //$data['jenis'] = $db->table('jenis_pelapor')->get()->getResultArray();

        return view('pengaduan/create');
    }

    /**
     * Memproses penyimpanan data pengaduan baru.
     */
public function store()
{
    // Proteksi keamanan role pelapor
    if (session()->get('role') != 'pelapor') {
        return redirect()->to('/pengaduan')->with('error', 'Akses ditolak!');
    }

    // Upload foto
    $file = $this->request->getFile('foto');
    $namaFoto = null;

    if ($file && $file->isValid()) {
        $namaFoto = $file->getRandomName();
        $file->move('uploads/pengaduan/', $namaFoto);
    }

    // Simpan data 
    $this->model->save([
        'id_user'   => session()->get('id_user'),
        'judul'     => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'lokasi'    => $this->request->getPost('lokasi'),
        'foto'      => $namaFoto,
        'status'    => 'menunggu'
    ]);

    // Notifikasi ke admin
    $db = db_connect();
    $admin = $db->table('users')
        ->where('role', 'admin')
        ->get()
        ->getResultArray();


foreach($admin as $a){

    // simpan notif database
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

    $db = db_connect();
    $tanggapan = $db->table('tanggapan')
        ->where('id_pengaduan', $id)
        ->get()
        ->getResultArray();

     //valdasi admin       
    if (
        session()->get('role') != 'pelapor' ||
        $pengaduan['status'] != 'menunggu' ||
        !empty($tanggapan)
    ) {
        return redirect()->to('/pengaduan')->with('error', 'Tidak bisa mengubah pengaduan');
    }

    // ✅ TAMBAHKAN INI
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
    ->join('jenis_pelapor', 'jenis_pelapor.id_jenis = users.id_jenis', 'left')
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
    $db = db_connect();

    $data['pengaduan'] = $db->table('pengaduan')
        ->select('pengaduan.*, users.nama as nama_pelapor, jenis_pelapor.nama_jenis, tanggapan.isi_tanggapan')
        ->join('users', 'users.id_user = pengaduan.id_user')
        ->join('jenis_pelapor', 'jenis_pelapor.id_jenis = users.id_jenis', 'left')
        ->join('tanggapan', 'tanggapan.id_pengaduan = pengaduan.id_pengaduan', 'left')
        ->get()
        ->getResultArray();

    return view('pengaduan/print', $data);
}
}
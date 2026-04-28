<?php

namespace App\Controllers;

use App\Models\PenugasanModel;

/**
 * Controller Penugasan
 * Mengelola alur kerja penugasan dari Admin ke Teknisi, termasuk sinkronisasi status pengaduan.
 */
class Penugasan extends BaseController
{
    protected $model;

    /**
     * Inisialisasi model penugasan agar dapat digunakan di seluruh method.
     */
    public function __construct()
    {
        $this->model = new PenugasanModel();
    }

    /**
     * Menampilkan daftar penugasan dengan fitur filter pencarian dan hak akses per role.
     */
    public function index()
    {
        $db = db_connect();

        // Mengambil parameter pencarian dari URL
        $pengaduan = $this->request->getGet('pengaduan');
        $teknisi   = $this->request->getGet('teknisi');
        $tanggal   = $this->request->getGet('tanggal');

        // Membangun query dengan join ke tabel pengaduan dan users
        $builder = $this->model
            ->select('penugasan.*, pengaduan.judul, users.nama')
            ->join('pengaduan', 'pengaduan.id_pengaduan = penugasan.id_pengaduan')
            ->join('users', 'users.id_user = penugasan.id_teknisi');

        // Filter Role: Jika teknisi, hanya tampilkan tugas yang diberikan kepadanya
        if(session()->get('role') == 'teknisi'){
            $builder->where('id_teknisi', session()->get('id_user'));
        }

        // Filter Pencarian: Berdasarkan judul pengaduan
        if($pengaduan){
            $builder->like('pengaduan.judul', $pengaduan);
        }

        // Filter Pencarian: Berdasarkan teknisi tertentu
        if($teknisi){
            $builder->where('penugasan.id_teknisi', $teknisi);
        }

        // Filter Pencarian: Berdasarkan tanggal penugasan
        if($tanggal){
            $builder->where('DATE(penugasan.tanggal_penugasan)', $tanggal);
        }

        // Eksekusi pengambilan data
        $data['penugasan'] = $builder->findAll();

        // Mengambil daftar teknisi untuk dropdown filter
        $data['teknisiList'] = $db->table('users')
            ->where('role','teknisi')
            ->get()->getResultArray();

        return view('penugasan/index', $data);
    }

    /**
     * Menampilkan formulir pembuatan tugas baru untuk Admin.
     */
    public function create()
    {
        // Validasi: Hanya Admin yang boleh membuat penugasan
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $db = db_connect();

        // Mengambil pengaduan yang sedang dalam status diproses
        $data['pengaduan'] = $db->table('pengaduan')
            ->where('status', 'diproses')
            ->get()
            ->getResultArray();

        // Mengambil daftar user dengan role teknisi
        $data['teknisi'] = $db->table('users')
            ->where('role', 'teknisi')
            ->get()->getResultArray();

        return view('penugasan/create', $data);
    }

    /**
     * Menyimpan data penugasan baru dan memperbarui status pengaduan terkait.
     */
    public function store()
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $id_pengaduan = $this->request->getPost('id_pengaduan');
        $id_teknisi   = $this->request->getPost('id_teknisi');

        // Simpan data penugasan
        $this->model->save([
            'id_pengaduan' => $id_pengaduan,
            'id_teknisi' => $id_teknisi,
            'tanggal_penugasan' => $this->request->getPost('tanggal_penugasan'),
            'status' => 'ditugaskan'
        ]);

        // Perbarui status pada tabel pengaduan menjadi diproses
        db_connect()->table('pengaduan')
            ->where('id_pengaduan', $id_pengaduan)
            ->update(['status' => 'diproses']);

        // Kirim notifikasi tugas baru kepada teknisi terkait
        db_connect()->table('notifikasi')->insert([
            'id_user' => $id_teknisi,
            'pesan' => 'Anda mendapatkan tugas baru',
            'status' => 'belum'
        ]);



        return redirect()->to('/penugasan');
    }

    /**
     * Menampilkan form edit penugasan (biasanya digunakan teknisi untuk update progres).
     */
    public function edit($id)
    {
        $data['penugasan'] = $this->model->find($id);
        return view('penugasan/edit', $data);
    }

    /**
     * Menghapus riwayat penugasan yang sudah selesai (Khusus Admin).
     */
    public function delete($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/penugasan')
                ->with('error','Tidak punya akses');
        }

        $data = $this->model->find($id);

        // Validasi: Hanya data dengan status selesai yang boleh dihapus
        if($data['status'] != 'selesai'){
            return redirect()->to('/penugasan')
                ->with('error','Hanya penugasan selesai yang boleh dihapus');
        }

        $this->model->delete($id);

        return redirect()->to('/penugasan')
            ->with('success','Penugasan berhasil dihapus');
    }

    /**
     * Memproses pembaruan status penugasan, upload bukti, dan notifikasi ke berbagai pihak.
     */
    public function update($id)
    {
        // Validasi: Hanya teknisi yang boleh memperbarui progres tugas
        if(session()->get('role') != 'teknisi'){
            return redirect()->to('/penugasan')
                ->with('error','Hanya teknisi yang boleh mengubah status');
        }

        $status = $this->request->getPost('status');
        $data = ['status' => $status];

        // Hak akses Admin: Hanya admin yang boleh mengubah tanggal penugasan
        if(session()->get('role') == 'admin'){
            $data['tanggal_penugasan'] = $this->request->getPost('tanggal_penugasan');
        }

        // Proses unggah foto bukti pengerjaan oleh teknisi
        $file = $this->request->getFile('foto_bukti');
        if ($file && $file->isValid()) {
            $nama = $file->getRandomName();
            $file->move('uploads/bukti/', $nama);
            $data['foto_bukti'] = $nama;
        }

        // Simpan perubahan pada tabel penugasan
        $this->model->update($id, $data);

        // Sinkronisasi: Jika penugasan selesai, maka status pengaduan juga menjadi selesai
        if($status == 'selesai'){
            $penugasan = $this->model->find($id);
            $db = db_connect();
            $db->table('pengaduan')
                ->where('id_pengaduan', $penugasan['id_pengaduan'])
                ->update(['status' => 'selesai']);

            // Ambil data pengaduan untuk mendapatkan ID pelapor
            $pengaduan = $db->table('pengaduan')
                ->where('id_pengaduan', $penugasan['id_pengaduan'])
                ->get()->getRowArray();

            // Kirim notifikasi penyelesaian tugas kepada pelapor
            $db->table('notifikasi')->insert([
                'id_user' => $pengaduan['id_user'],
                'pesan' => 'Pengaduan Anda telah selesai',
                'status' => 'belum'
            ]);
        }

        // Kirim notifikasi perubahan status kepada semua Admin
        $db = db_connect();
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

    /**
     * Mengambil seluruh data penugasan untuk keperluan cetak laporan.
     */
    public function print()
    {
        $data['penugasan'] = $this->model
            ->select('penugasan.*, pengaduan.judul, users.nama')
            ->join('pengaduan', 'pengaduan.id_pengaduan = penugasan.id_pengaduan')
            ->join('users', 'users.id_user = penugasan.id_teknisi')
            ->findAll();

        return view('penugasan/print', $data);
    }

    /**
     * Menampilkan detail spesifik dari satu record penugasan.
     */
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
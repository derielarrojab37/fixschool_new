<?php

namespace App\Controllers;

use App\Models\TanggapanModel;

/**
 * Controller Tanggapan
 * Menangani pemberian respon dari Admin terhadap pengaduan yang masuk,
 * termasuk perubahan status pengaduan dan sistem notifikasi ke pelapor.
 */
class Tanggapan extends BaseController
{
    protected $model;

    /**
     * Inisialisasi TanggapanModel agar dapat digunakan di seluruh method.
     */
    public function __construct()
    {
        $this->model = new TanggapanModel();
    }

    /**
     * Menampilkan daftar semua tanggapan dengan fitur filter pencarian dan tanggal.
     */
    public function index()
    {
        // Mengambil parameter pencarian dari query string
        $keyword = $this->request->getGet('keyword');
        $tanggal = $this->request->getGet('tanggal');

        // Membangun query dengan join ke tabel pengaduan dan users
        $builder = $this->model
            ->select('tanggapan.*, pengaduan.judul, users.nama')
            ->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan')
            ->join('users', 'users.id_user = tanggapan.id_user');

        // Logika Filter: Berdasarkan isi tanggapan atau judul pengaduan
        if($keyword){
            $builder->like('isi_tanggapan', $keyword)
                    ->orLike('pengaduan.judul', $keyword);
        }

        // Logika Filter: Berdasarkan tanggal tanggapan diberikan
        if($tanggal){
            $builder->where('DATE(tanggapan.tanggal)', $tanggal);
        }

        $data['tanggapan'] = $builder->findAll();

        return view('tanggapan/index', $data);
    }

    /**
     * Menampilkan formulir pembuatan tanggapan untuk satu pengaduan tertentu.
     */
    public function create($id_pengaduan)
    {
        // Validasi Hak Akses: Hanya Admin yang dapat memberikan tanggapan resmi
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $db = db_connect();

        // Mengambil data pengaduan yang akan ditanggapi
        $data['pengaduan'] = $db->table('pengaduan')
            ->where('id_pengaduan', $id_pengaduan)
            ->get()->getRowArray();

        return view('tanggapan/create', $data);
    }

    /**
     * Memproses penyimpanan tanggapan baru, unggah berkas bukti, 
     * memperbarui status pengaduan, dan mengirim notifikasi ke pelapor.
     */
    public function store()
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        // Penanganan unggah foto bukti tanggapan
        $file = $this->request->getFile('foto');
        $namaFoto = null;

        if ($file && $file->isValid()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/tanggapan/', $namaFoto);
        }

        $id_pengaduan = $this->request->getPost('id_pengaduan');

        // Menyimpan data tanggapan ke database
        $this->model->save([
            'id_pengaduan' => $id_pengaduan,
            'id_user' => session()->get('id_user'),
            'isi_tanggapan' => $this->request->getPost('isi_tanggapan'),
            'foto' => $namaFoto
        ]);

        // Sinkronisasi: Memperbarui status pengaduan menjadi 'diproses' setelah diberi tanggapan
        db_connect()->table('pengaduan')
            ->where('id_pengaduan', $id_pengaduan)
            ->update(['status' => 'diproses']);

        // Mengambil data pengaduan untuk keperluan informasi notifikasi
        $pengaduan = db_connect()->table('pengaduan')
            ->where('id_pengaduan', $id_pengaduan)
            ->get()->getRowArray();

        // Mengirimkan notifikasi kepada pelapor bahwa laporan mereka sedang ditangani
        db_connect()->table('notifikasi')->insert([
            'id_user' => $this->request->getPost('id_user_pengaduan'),
            'pesan' => 'Pengaduan Anda sedang diproses',
            'status' => 'belum',
            'tanggal' => date('Y-m-d H:i:s')
        ]);



        return redirect()->to('/pengaduan/detail/' . $id_pengaduan);
    }

    /**
     * Menampilkan form untuk menyunting (edit) isi tanggapan yang sudah ada.
     */
    public function edit($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $data['tanggapan'] = $this->model->find($id);

        return view('tanggapan/edit', $data);
    }

    /**
     * Memperbarui data tanggapan di database berdasarkan input form edit.
     */
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

    /**
     * Menghapus data tanggapan dari database.
     */
    public function delete($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $this->model->delete($id);
        return redirect()->to('/tanggapan');
    }

    /**
     * Menyiapkan data seluruh tanggapan untuk ditampilkan pada format cetak.
     */
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

    /**
     * Menampilkan detail spesifik dari satu data tanggapan.
     */
    public function detail($id)
    {
        $data['tanggapan'] = $this->model->find($id);
        return view('tanggapan/detail', $data);
    }
}
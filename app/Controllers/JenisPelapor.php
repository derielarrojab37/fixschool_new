<?php

namespace App\Controllers;

use App\Models\JenisPelaporModel;

/**
 * Controller JenisPelapor
 * Mengelola data master kategori atau jenis pelapor yang ada dalam sistem.
 */
class JenisPelapor extends BaseController
{
    // Properti untuk menampung instance model
    protected $model;

    // --- CONSTRUCTOR ---
    // Inisialisasi JenisPelaporModel agar dapat digunakan di seluruh fungsi dalam class ini
    public function __construct()
    {
        $this->model = new JenisPelaporModel();
    }

    // --- HALAMAN UTAMA (INDEX) ---
    // Menampilkan daftar seluruh jenis pelapor yang tersimpan di database
    public function index()
    {
        $data['jenis'] = $this->model->findAll();
        return view('jenis_pelapor/index', $data);
    }

    // --- FORM TAMBAH (CREATE) ---
    // Menampilkan halaman formulir untuk menambah jenis pelapor baru
    public function create()
    {
        return view('jenis_pelapor/create');
    }

    // --- PROSES SIMPAN (STORE) ---
    // Menangani logika penyimpanan data baru dari form ke dalam database
    public function store()
    {
        $this->model->save([
            'nama_jenis' => $this->request->getPost('nama_jenis')
        ]);

        return redirect()->to('/jenispelapor');
    }

    // --- FORM UBAH (EDIT) ---
    // Menampilkan formulir edit dengan data lama berdasarkan ID yang dipilih
    public function edit($id)
    {
        $data['jenis'] = $this->model->find($id);
        return view('jenis_pelapor/edit', $data);
    }

    // --- PROSES PERBARUI (UPDATE) ---
    // Menangani logika perubahan data berdasarkan ID tertentu
    public function update($id)
    {
        $this->model->update($id, [
            'nama_jenis' => $this->request->getPost('nama_jenis')
        ]);

        return redirect()->to('/jenispelapor');
    }

    // --- PROSES HAPUS (DELETE) ---
    // Menghapus data jenis pelapor dari database berdasarkan ID
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/jenispelapor');
    }
}
<?php

// Namespace controller (menentukan lokasi file dalam struktur CI4)
namespace App\Controllers;

// Menggunakan model NotifikasiModel untuk interaksi database
use App\Models\NotifikasiModel;

/**
 * Controller Notifikasi
 * Menangani tampilan pesan pemberitahuan sistem dan manajemen status baca pengguna.
 */
class Notifikasi extends BaseController
{
    // --- HALAMAN DAFTAR NOTIFIKASI ---
    // Menampilkan semua notifikasi yang ditujukan khusus untuk pengguna yang sedang login
    public function index()
    {
        // Inisialisasi model notifikasi
        $model = new NotifikasiModel();

        // Mengambil data notifikasi berdasarkan ID pengguna dari session
        $data['notifikasi'] = $model
            ->where('id_user', session()->get('id_user'))
            ->findAll();

        // Mengirimkan data ke view notifikasi/index
        return view('notifikasi/index', $data);
    }

    // --- PROSES BERSIHKAN NOTIFIKASI ---
    // Menghapus seluruh riwayat notifikasi milik pengguna yang sedang login
    public function clear()
    {
        // Inisialisasi model notifikasi
        $model = new NotifikasiModel();

        // Melakukan penghapusan data berdasarkan ID pengguna di session
        $model->where('id_user', session()->get('id_user'))->delete();

        // Mengalihkan kembali ke dashboard dengan pesan sukses
        return redirect()->to('/dashboard')->with('success', 'Notifikasi berhasil dibersihkan');
    }
}
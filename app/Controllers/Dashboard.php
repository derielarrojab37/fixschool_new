<?php

namespace App\Controllers;

use App\Models\NotifikasiModel;
use App\Models\PengaduanModel;
use App\Models\UsersModel;

/**
 * Controller Dashboard
 * Menangani tampilan utama statistik dan sistem pemantauan SLA (Service Level Agreement).
 */
class Dashboard extends BaseController
{
    // --- HALAMAN UTAMA DASHBOARD ---
    // Fungsi untuk menampilkan data statistik dan mengecek status tenggat waktu pengaduan
    public function index()
    {
        // KEAMANAN: Memastikan hanya user yang sudah login yang bisa mengakses dashboard
        if (!session()->get('id_user')) {
            return redirect()->to('/login');
        }

        // INISIALISASI: Memanggil Model dan Koneksi Database
        $notifModel = new NotifikasiModel();
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // --- PROSES MONITORING SLA (DEADLINE) ---
        // 1. UPDATE STATUS TERLAMBAT: Jika deadline sudah lewat dan status belum selesai
        $db->table('pengaduan')
            ->set('status_sla', 'terlambat')
            ->where('deadline <', $now)
            ->where('status !=', 'selesai')
            ->update();

        // 2. UPDATE STATUS HAMPIR: Jika deadline tersisa kurang dari 24 jam ke depan
        $db->table('pengaduan')
            ->set('status_sla', 'hampir')
            ->where('deadline >=', $now)
            ->where('deadline <=', date('Y-m-d H:i:s', strtotime('+1 day')))
            ->update();

        // 3. UPDATE STATUS AMAN: Jika deadline masih lebih dari 1 hari ke depan
        $db->table('pengaduan')
            ->set('status_sla', 'aman')
            ->where('deadline >', date('Y-m-d H:i:s', strtotime('+1 day')))
            ->update();

        // --- SISTEM NOTIFIKASI OTOMATIS ---
        // Mengambil daftar pengaduan yang telat untuk dikirimkan notifikasi ke Admin
        $telat = $db->table('pengaduan')
            ->where('status_sla', 'terlambat')
            ->get()->getResultArray();

        foreach ($telat as $t) {
            $db->table('notifikasi')->insert([
                'id_user' => 1, // ID user tujuan notifikasi (Admin)
                'pesan'   => 'Pengaduan "' . $t['judul'] . '" melewati deadline!',
                'status'  => 'belum',
                'tanggal' => date('Y-m-d H:i:s')
            ]);
        }

        // --- PENGUMPULAN DATA UNTUK VIEW ---
        // Menyusun semua data statistik yang akan ditampilkan di halaman dashboard
        $data = [
            // Mengambil notifikasi khusus untuk user yang sedang login
            'notif'      => $notifModel->where('id_user', session()->get('id_user'))
                                       ->orderBy('tanggal', 'DESC')
                                       ->findAll(),
                                       
            // Menghitung total user terdaftar
            'total_user' => $db->table('users')->countAllResults(),
            
            // Menghitung statistik pengaduan berdasarkan status
            'selesai'    => $db->table('pengaduan')->where('status', 'selesai')->countAllResults(),
            'diproses'   => $db->table('pengaduan')->where('status', 'diproses')->countAllResults(),
            'ditolak'    => $db->table('pengaduan')->where('status', 'ditolak')->countAllResults(),
            'menunggu'   => $db->table('pengaduan')->where('status', 'menunggu')->countAllResults(),
        ];

        // --- TAMPILKAN VIEW ---
        // Mengirimkan data yang sudah dikumpulkan ke file layout dashboard
        return view('layouts/dashboard', $data);
    }
}
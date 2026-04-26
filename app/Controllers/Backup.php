<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Controller Backup
 * Berfungsi untuk melakukan ekspor database secara otomatis ke dalam format file .sql
 */
class Backup extends Controller
{
    // --- FUNGSI UTAMA BACKUP ---
    // Menangani proses pengambilan data dari database dan mengunduhnya
    public function index()
    {
        // Proteksi Halaman: Hanya user dengan role 'admin' yang bisa mengakses fitur ini
        if (session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        // Konfigurasi Database: Mengambil parameter koneksi dari sistem dan file .env
        $db         = \Config\Database::connect();
        $dbName     = $db->getDatabase();
        $user       = env('database.default.username');
        $pass       = env('database.default.password');
        $host       = env('database.default.hostname');
        
        // Penentuan Lokasi Simpan: Menyimpan file di folder 'writable/backup' dengan format nama tanggal
        $backupFile = WRITEPATH . 'backup/backup-' . date('Y-m-d_H-i-s') . '.sql';

        // Validasi Direktori: Memastikan folder backup tersedia, jika belum maka dibuat otomatis
        if (!is_dir(WRITEPATH . 'backup')) {
            mkdir(WRITEPATH . 'backup', 0777, true);
        }

        // Konfigurasi Path Executable: Mengatur lokasi file mysqldump sesuai sistem operasi
        $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump'; // Path untuk lingkungan Windows (XAMPP)
        // $mysqldumpPath = '/usr/bin/mysqldump';        // Path untuk lingkungan Linux/Mac

        // Perintah Eksekusi: Menyusun perintah shell untuk melakukan dump database
        $command = "{$mysqldumpPath} --user={$user} --password={$pass} --host={$host} {$dbName} > {$backupFile}";

        // Menjalankan Perintah: Mengeksekusi command melalui fungsi system di server
        system($command, $output);

        // Validasi & Unduh: Mengecek apakah file berhasil dibuat dan isinya tidak kosong
        if (file_exists($backupFile) && filesize($backupFile) > 0) {
            // Memicu browser untuk mengunduh file hasil backup
            return $this->response->download($backupFile, null);
        } else {
            // Pesan Galat: Ditampilkan jika terjadi kegagalan sistem atau salah konfigurasi path
            return "Backup gagal. Periksa konfigurasi database Anda atau perintah mysqldump.";
        }
    }
}
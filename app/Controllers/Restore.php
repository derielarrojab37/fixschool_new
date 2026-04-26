<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Controller Restore
 * Digunakan untuk mengembalikan data database dari file cadangan (.sql) dengan proteksi password tambahan.
 */
class Restore extends Controller
{
    /**
     * Password khusus untuk mengakses fitur restore guna meningkatkan keamanan sistem.
     */
    private $restorePassword = 'fix123';

    /**
     * Menampilkan halaman login khusus untuk otorisasi akses fitur restore.
     */
    public function index()
    {
        return view('restore/restore_login');
    }

    /**
     * Memvalidasi password restore yang diinput oleh pengguna.
     */
    public function auth()
    {
        $password = $this->request->getPost('password');

        // Jika password cocok, simpan status akses ke dalam session
        if ($password === $this->restorePassword) {
            session()->set('restore_access', true);
            return redirect()->to('/restore/form');
        }

        // Kembali ke halaman sebelumnya jika password tidak sesuai
        return redirect()->back()->with('error', 'Password salah!');
    }

    /**
     * Menampilkan formulir unggah file SQL jika pengguna sudah terautentikasi.
     */
    public function form()
    {
        // Pengecekan session akses restore
        if (!session()->get('restore_access')) {
            return redirect()->to('/restore');
        }

        return view('restore/restore');
    }

    /**
     * Memproses file SQL yang diunggah untuk dimasukkan kembali ke dalam database.
     */
    public function process()
    {
        // Validasi akses session
        if (!session()->get('restore_access')) {
            return redirect()->to('/restore');
        }

        // Mengambil file yang diunggah dari form
        $file = $this->request->getFile('file_sql');

        // Validasi keberadaan dan validitas file
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        // Validasi ekstensi file harus berformat .sql
        $ext = strtolower($file->getClientExtension());
        if ($ext !== 'sql') {
            return redirect()->back()->with('error', 'File harus berformat .sql');
        }

        // Konfigurasi nama database tujuan
        $dbName = 'db_fixschool';

        // Melakukan koneksi awal menggunakan mysqli untuk pengecekan database
        $conn = new \mysqli('localhost', 'root', '', '');

        if ($conn->connect_error) {
            die('Koneksi gagal');
        }

        // Otomatis membuat database jika nama database tersebut belum tersedia di server
        $conn->query("CREATE DATABASE IF NOT EXISTS $dbName");

        // Memilih database yang akan digunakan untuk proses restore
        $conn->select_db($dbName);

        // Menghubungkan ke database melalui framework CodeIgniter
        $db = \Config\Database::connect();

        try {
            // Membaca file SQL baris demi baris
            $sqlLines = file($file->getTempName());
            $query = '';

            foreach ($sqlLines as $line) {
                $line = trim($line);

                // Abaikan baris yang kosong atau merupakan komentar SQL
                if ($line == '' || substr($line, 0, 2) == '--') {
                    continue;
                }

                $query .= $line;

                // Jika menemukan tanda titik koma (;), jalankan perintah sebagai satu query utuh
                if (substr($line, -1) == ';') {
                    $db->query($query);
                    $query = '';
                }
            }

            // Menghapus status akses restore dari session setelah proses selesai
            session()->remove('restore_access');

            return redirect()->to('/')->with('success', 'Restore berhasil!');
        } catch (\Exception $e) {
            // Menangkap dan menampilkan pesan error jika proses eksekusi SQL gagal
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
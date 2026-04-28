<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

/**
 * Controller Auth
 * Mengangani fungsi autentikasi pengguna seperti login dan logout.
 */
class Auth extends Controller
{
    // --- HALAMAN LOGIN ---
    // Menampilkan halaman form login kepada pengguna
    public function login()
    {
        return view('auth/login');
    }

    // --- LOGIKA AUTENTIKASI ---
    // Memproses kredensial yang dikirim melalui form login
    public function prosesLogin()
    {
        // Inisialisasi session dan model pengguna
        $session = session();
        $usersModel = new UsersModel();

        // Mengambil input dari form login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Mencari data pengguna berdasarkan username melalui model
        $users = $usersModel->getUsersByUsername($username);

        if ($users) {
            // Verifikasi apakah password input cocok dengan hash di database
            if (password_verify($password, $users['password'])) {
                
                // Set data identitas pengguna ke dalam session jika login berhasil
                $session->set([
                    'id_user'   => $users['id_user'],
                    'nama'      => $users['nama'],
                    'no_hp'     => $users['no_hp'],
                    'username'  => $users['username'],
                    'role'      => $users['role'],
                    'foto'      => $users['foto'],
                    'logged_in' => true
                ]);

                // Redirect ke halaman dashboard
                return redirect()->to('/dashboard');
            } else {
                // Notifikasi jika password tidak sesuai
                $session->setFlashdata('salahpw', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            // Notifikasi jika username tidak terdaftar dalam sistem
            $session->setFlashdata('error', 'Nama tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    // --- PROSES KELUAR (LOGOUT) ---
    // Menghapus seluruh data session dan mengarahkan kembali ke halaman login
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
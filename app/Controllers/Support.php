<?php

namespace App\Controllers;

use App\Models\SupportModel;

/**
 * Controller Support
 * Mengelola sistem tiket bantuan (Helpdesk) yang memungkinkan pelapor berkomunikasi dengan admin.
 */
class Support extends BaseController
{
    protected $model;

    /**
     * Inisialisasi SupportModel agar dapat diakses di seluruh fungsi dalam controller ini.
     */
    public function __construct()
    {
        $this->model = new SupportModel();
    }

    /**
     * Menampilkan halaman formulir pembuatan tiket baru bagi pengguna.
     */
    public function create()
    {
        return view('support/create');
    }

    /**
     * Memproses penyimpanan tiket baru ke database.
     * Meliputi validasi input, penyimpanan data, dan pengiriman notifikasi ke admin.
     */
    public function store()
    {
        // Validasi ketersediaan data judul dan pesan
        if (!$this->request->getPost('judul') || !$this->request->getPost('pesan')) {
            return redirect()->back()->with('error', 'Data tidak lengkap');
        }

        $db = db_connect();
    
        // Menyimpan data tiket dengan status awal 'open'
        $this->model->save([
            'id_user'    => session()->get('id_user'),
            'judul'      => $this->request->getPost('judul'),
            'pesan'      => $this->request->getPost('pesan'),
            'status'     => 'open',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Mengirimkan notifikasi ke Admin bahwa terdapat tiket baru yang masuk
        $db->table('notifikasi')->insert([
            'id_user' => 1, // Mengasumsikan ID 1 adalah Admin Utama
            'pesan'   => 'Tiket support baru masuk',
            'status'  => 'belum',
            'tanggal' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/support')->with('success', 'Tiket berhasil dibuat');
    }

    /**
     * Menampilkan daftar tiket bantuan.
     * Admin dapat melihat seluruh tiket, sedangkan pelapor hanya melihat tiket milik mereka sendiri.
     */
    public function index()
    {
        $role = session()->get('role');
        $id_user = session()->get('id_user');

        if ($role == 'admin') {
            // Pengambilan semua data tiket untuk hak akses Admin
            $data['ticket'] = $this->model->orderBy('id_support', 'DESC')->findAll();
        } else {
            // Pengambilan data terbatas berdasarkan ID user untuk hak akses Pelapor/Teknisi
            $data['ticket'] = $this->model->where('id_user', $id_user)
                                          ->orderBy('id_support', 'DESC')
                                          ->findAll();
        }

        return view('support/index', $data);
    }

    /**
     * Menampilkan rincian tiket beserta seluruh riwayat percakapan (balasan).
     */
    public function detail($id)
    {
        $db = db_connect();

        // Mengambil data tiket berdasarkan ID
        $data['tiket'] = $this->model->find($id);

        // Validasi keamanan jika tiket tidak ditemukan dalam database
        if (!$data['tiket']) {
            return redirect()->to('/support')->with('error', 'Tiket tidak ditemukan');
        }

        // Mengambil seluruh balasan terkait tiket ini dengan join ke tabel users untuk mendapatkan nama pengirim
        $data['reply'] = $db->table('support_reply')
            ->select('support_reply.*, users.nama')
            ->join('users', 'users.id_user = support_reply.id_user')
            ->where('id_support', $id)
            ->orderBy('id_reply', 'ASC')
            ->get()
            ->getResultArray();

        return view('support/detail', $data);
    }

    /**
     * Memproses pengiriman balasan pada tiket.
     * Mengatur otorisasi akses dan memperbarui status tiket secara otomatis berdasarkan pengirim.
     */
    public function reply($id)
    {
        $db = db_connect();
        $role = session()->get('role');
        $id_user = session()->get('id_user');

        // Memvalidasi keberadaan tiket sebelum memproses balasan
        $tiket = $this->model->find($id);
        
        if (!$tiket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan');
        }

        // Proteksi Akses: Mencegah user lain membalas tiket yang bukan miliknya (kecuali Admin)
        if ($role != 'admin' && $tiket['id_user'] != $id_user) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        // Menyimpan data balasan baru ke tabel support_reply
        $db->table('support_reply')->insert([
            'id_support' => $id,
            'id_user'    => $id_user,
            'pesan'      => $this->request->getPost('pesan'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        /**
         * Logika Pembaruan Status:
         * - Jika Admin membalas, tiket dianggap sudah ditangani (status: closed).
         * - Jika Pelapor membalas kembali, status menjadi 'open' agar admin menyadari ada respon baru.
         */
        $newStatus = ($role == 'admin') ? 'closed' : 'open';
        $this->model->update($id, ['status' => $newStatus]);

        // Mengirimkan notifikasi ke Admin jika balasan dikirimkan oleh pelapor
        if ($role == 'pelapor') {
            $db->table('notifikasi')->insert([
                'id_user' => 1,
                'pesan'   => session()->get('nama') . ' membalas tiket: ' . $tiket['judul'],
                'status'  => 'belum',
                'tanggal' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->back()->with('success', 'Pesan terkirim');
    }
}
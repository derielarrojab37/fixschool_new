<?php

namespace App\Controllers;

use App\Models\SupportModel;

class Support extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SupportModel();
    }

    // =========================
    // FORM BUAT TIKET
    // =========================
    public function create()
    {
        return view('support/create');
    }

    // =========================
    // SIMPAN TIKET
    // =========================
    public function store()
    {
        if(!$this->request->getPost('judul') || !$this->request->getPost('pesan')){
        return redirect()->back()->with('error','Data tidak lengkap');
        }

        $db = db_connect();
    
    $this->model->save([
    'id_user' => session()->get('id_user'),
    'judul' => $this->request->getPost('judul'),
    'pesan' => $this->request->getPost('pesan'),
    'status' => 'open',
    'created_at' => date('Y-m-d H:i:s')
]);


        // 🔔 NOTIF ADMIN
        $db->table('notifikasi')->insert([
            'id_user' => 1,
            'pesan' => 'Tiket support baru masuk',
            'status' => 'belum',
            'tanggal' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/support')->with('success','Tiket berhasil dibuat');
    }

    // =========================
    // LIST TIKET
    // =========================
    public function index()
{
    $role = session()->get('role');
    $id_user = session()->get('id_user');

    if ($role == 'admin') {
        // Admin melihat semua tiket
        $data['ticket'] = $this->model->orderBy('id_support','DESC')->findAll();
    } else {
        // Pelapor hanya melihat tiket miliknya sendiri
        $data['ticket'] = $this->model->where('id_user', $id_user)
                                      ->orderBy('id_support','DESC')
                                      ->findAll();
    }

    return view('support/index', $data);
}

    // =========================
    // DETAIL TIKET
    // =========================
    public function detail($id)
    {
        $db = db_connect();

        $data['tiket'] = $this->model->find($id);

        // ❗ CEK BIAR GAK ERROR
        if(!$data['tiket']){
            return redirect()->to('/support')->with('error','Tiket tidak ditemukan');
        }

        $data['reply'] = $db->table('support_reply')
            ->select('support_reply.*, users.nama')
            ->join('users','users.id_user = support_reply.id_user')
            ->where('id_support', $id)
            ->orderBy('id_reply','ASC')
            ->get()
            ->getResultArray();

        return view('support/detail', $data);
    }

    // =========================
// BALAS TIKET (UMUM - ADMIN & PELAPOR)
// =========================
public function reply($id)
{
    $db = db_connect();
    $role = session()->get('role');
    $id_user = session()->get('id_user');

    // Ambil data tiket untuk cek kepemilikan (jika pelapor)
    $tiket = $this->model->find($id);
    
    if (!$tiket) {
        return redirect()->back()->with('error', 'Tiket tidak ditemukan');
    }

    // Proteksi: Jika bukan admin, pastikan dia adalah pemilik tiket tersebut
    if ($role != 'admin' && $tiket['id_user'] != $id_user) {
        return redirect()->back()->with('error', 'Akses ditolak');
    }

    // Insert balasan
    $db->table('support_reply')->insert([
        'id_support' => $id,
        'id_user'    => $id_user,
        'pesan'      => $this->request->getPost('pesan'),
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // LOGIKA UPDATE STATUS:
    // Jika yang balas Admin -> Status jadi 'closed' (atau bisa Anda ganti 'answered')
    // Jika yang balas Pelapor -> Status balik jadi 'open' (biar admin tahu ada balasan baru)
    $newStatus = ($role == 'admin') ? 'closed' : 'open';

    $this->model->update($id, ['status' => $newStatus]);

    // Kirim Notif ke Admin jika yang balas adalah pelapor
    if ($role == 'pelapor') {
        $db->table('notifikasi')->insert([
            'id_user' => 1, // ID Admin
            'pesan'   => session()->get('nama') . ' membalas tiket: ' . $tiket['judul'],
            'status'  => 'belum',
            'tanggal' => date('Y-m-d H:i:s')
        ]);
    }

    return redirect()->back()->with('success', 'Pesan terkirim');
}
}
<?php

// Namespace controller menentukan lokasi file dalam struktur direktori CodeIgniter 4
namespace App\Controllers;

// Mengimpor model UsersModel untuk berinteraksi dengan tabel pengguna di database
use App\Models\UsersModel;

/**
 * Controller Users
 * Mengelola seluruh data pengguna mulai dari pendaftaran, manajemen profil,
 * hingga fitur ekspor dan integrasi WhatsApp.
 */
class Users extends BaseController
{
    // Properti dilindungi untuk menampung instance dari UsersModel
    protected $users;

    /**
     * Constructor
     * Berfungsi menginisialisasi model pengguna saat controller pertama kali diakses.
     */
    public function __construct()
    {
        $this->users = new UsersModel();
    }

    /**
     * Menampilkan halaman formulir untuk menambah pengguna baru.
     */
    public function create()
{
    $db = db_connect();

    $data['jenis'] = $db->table('jenis_pelapor')->get()->getResultArray();

    return view('users/create', $data);
}
    

    /**
     * Memproses penyimpanan data pengguna baru.
     * Mencakup validasi input, pengamanan password (hashing), dan manajemen unggahan foto.
     */
    public function store()
    {
        // Menyiapkan service validasi bawaan CodeIgniter
        $validation = \Config\Services::validation();

        // Mendefinisikan aturan validasi untuk memastikan integritas data
        $validation->setRules([
            'nama'     => 'required',
            'no_hp'    => 'required|numeric|min_length[10]|max_length[15]',
            'username' => 'required|is_unique[users.username]', // Mencegah duplikasi username
            'password' => 'required|min_length[4]',
            'role'     => 'required',
        ]);

        // Menghentikan proses jika input tidak sesuai aturan dan mengirim kembali pesan error
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', implode('<br>', $validation->getErrors()));
        }

        // Logika Manajemen File: Menangkap file gambar dari input 'foto'
        $foto = $this->request->getFile('foto');
        $namaFoto = null;

        // Memindahkan file ke direktori fisik jika file valid dan diunggah secara benar
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName(); // Nama acak untuk mencegah konflik nama file
            $foto->move(FCPATH . 'uploads/users', $namaFoto);
        }

        // Menyimpan seluruh data ke database melalui model
$this->users->save([
    'nama'     => $this->request->getPost('nama'),
    'no_hp'    => $this->request->getPost('no_hp'), // ganti dari email
    'username' => $this->request->getPost('username'),
    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    'role' => (session()->get('role') == 'admin') 
        ? $this->request->getPost('role')
        : 'pelapor',
    'foto'     => $namaFoto,
    'id_jenis' => $this->request->getPost('id_jenis')
]);
        


        return redirect()->to('/login')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Menampilkan daftar pengguna dengan sistem pencarian dan penomoran halaman (pagination).
     */
    public function index()
    {
        // Menangkap parameter input untuk keperluan filter
        $keyword = $this->request->getGet('keyword');
        $role = $this->request->getGet('role');

        $builder = $this->users;

        // Melakukan filter nama jika kata kunci pencarian dimasukkan
        if ($keyword) {
            $builder = $builder->like('nama', $keyword);
        }

        // Melakukan filter berdasarkan tingkatan akses pengguna
        if ($role) {
            $builder = $builder->where('role', $role);
        }

        // Mengambil data dengan batasan 10 baris per halaman
        $data['users'] = $builder->paginate(10);
        $data['pager'] = $this->users->pager; // Menyiapkan objek navigasi halaman

        return view('users/index', $data);
    }

    /**
     * Menampilkan formulir edit untuk mengubah data pengguna berdasarkan ID.
     */
    public function edit($id)
    {
        $data['user'] = $this->users->find($id);
        return view('users/edit', $data);
    }

    /**
     * Memperbarui data pengguna.
     * Fungsi ini secara otomatis menghapus foto lama jika pengguna menggantinya dengan foto baru.
     */
    public function update($id)
    {
        $user = $this->users->find($id);
        $fotoBaru = $this->request->getFile('foto');
        $namaFoto = $user['foto'];

        // Jika terdapat unggahan file baru yang valid
        if ($fotoBaru && $fotoBaru->isValid() && $fotoBaru->getName() != '') {
            // Menghapus file fisik foto lama dari server untuk menghemat ruang penyimpanan
            if (!empty($user['foto']) && file_exists(FCPATH . 'uploads/users/' . $user['foto'])) {
                unlink(FCPATH . 'uploads/users/' . $user['foto']);
            }

            $namaFoto = $fotoBaru->getRandomName();
            $fotoBaru->move(FCPATH . 'uploads/users', $namaFoto);
        }

$data = [
    'nama'     => $this->request->getPost('nama'),
    'no_hp'    => $this->request->getPost('no_hp'), // ✅ ganti
    'username' => $this->request->getPost('username'),
    'foto'     => $namaFoto
];

    // HANYA ADMIN BOLEH UBAH ROLE
    if(session()->get('role') == 'admin'){
     $data['role'] = $this->request->getPost('role');
    }

        // Hanya melakukan pembaharuan password jika kolom password diisi oleh pengguna
        if ($this->request->getPost('password') != "") {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->users->update($id, $data);

        return redirect()->to('/users')->with('success', 'Data user berhasil diupdate!');
    }

    /**
     * Menghapus pengguna secara permanen dari database dan menghapus file fotonya.
     */
    public function delete($id)
{
    $db = db_connect();

    $user = $this->users->find($id);

    // CEGAH ADMIN HAPUS DIRI SENDIRI
    if(session()->get('id_user') == $id){
        return redirect()->to('/users')
            ->with('error','Tidak bisa menghapus akun sendiri!');
    }

    // HAPUS RELASI DULU (PENTING)
    $db->table('notifikasi')->where('id_user', $id)->delete();
    $db->table('pengaduan')->where('id_user', $id)->delete();
    $db->table('tanggapan')->where('id_user', $id)->delete();
    $db->table('penugasan')->where('id_teknisi', $id)->delete();

    // HAPUS FOTO
    if ($user['foto'] && file_exists(FCPATH . 'uploads/users/' . $user['foto'])) {
        unlink(FCPATH . 'uploads/users/' . $user['foto']);
    }

    // HAPUS USER
    $this->users->delete($id);

    return redirect()->to('/users')->with('success', 'User berhasil dihapus!');
}

    /**
     * Menampilkan informasi rincian lengkap dari satu pengguna.
     */
    public function detail($id)
    {
        $user = $this->users->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'Data tidak ditemukan');
        }

        return view('users/detail', ['user' => $user]);
    }

    /**
     * Menghasilkan tampilan data seluruh pengguna untuk kebutuhan cetak laporan.
     */
public function print()
{
    $keyword = $this->request->getGet('keyword');
    $role = $this->request->getGet('role');

    $builder = $this->users->builder();
    $builder->select('id_user, nama, no_hp, username, role');

    if ($keyword) {
        $builder->groupStart()
            ->like('nama', $keyword)
            ->orLike('no_hp', $keyword)
            ->orLike('username', $keyword)
        ->groupEnd();
    }

    if ($role) {
        $builder->where('role', $role);
    }

    $data['users'] = $builder->get()->getResultArray();

    return view('users/print', $data);
}

    /**
     * Mengintegrasikan data pengguna ke aplikasi eksternal WhatsApp.
     * Mengonversi data pengguna menjadi format teks pesan dan melakukan pengalihan URL.
     */
    
}
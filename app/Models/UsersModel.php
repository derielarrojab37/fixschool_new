<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    
    // Menyimpan profil user termasuk password_hash dan role (admin/teknisi/pelapor)
    protected $allowedFields = ['nama', 'username', 'password', 'role', 'foto', 'status'];

    /**
     * Method untuk mencari satu user berdasarkan username.
     * Biasanya digunakan dalam proses autentikasi (Login).
     */
    public function getUsersByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
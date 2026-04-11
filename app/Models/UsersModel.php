<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'username', 'password', 'role','jenis_pelapor', 'foto','status'];

    public function getUsersByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}

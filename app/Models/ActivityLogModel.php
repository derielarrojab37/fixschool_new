<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    // Nama tabel di database yang dikelola oleh model ini
    protected $table = 'activity_log';
    
    // Nama kolom yang menjadi primary key (kunci utama)
    protected $primaryKey = 'id_log';
    
    // Daftar kolom yang diizinkan untuk proses manipulasi data (insert/update)
    protected $allowedFields = ['id_user', 'aktivitas', 'waktu'];
}
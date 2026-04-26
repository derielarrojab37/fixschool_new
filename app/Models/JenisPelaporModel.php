<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPelaporModel extends Model
{
    // Menentukan tabel target: jenis_pelapor
    protected $table = 'jenis_pelapor';
    
    // Menentukan primary key: id_jenis
    protected $primaryKey = 'id_jenis';

    // Kolom yang dapat diisi melalui fungsi save() atau insert()
    protected $allowedFields = ['nama_jenis'];
}
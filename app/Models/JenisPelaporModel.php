<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPelaporModel extends Model
{
    protected $table = 'jenis_pelapor';
    protected $primaryKey = 'id_jenis';

    protected $allowedFields = ['nama_jenis'];
}
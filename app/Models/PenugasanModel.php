<?php

namespace App\Models;

use CodeIgniter\Model;

class PenugasanModel extends \CodeIgniter\Model {
    protected $table = 'penugasan';
    protected $primaryKey = 'id_penugasan';
    protected $allowedFields = [
        'id_pengaduan','id_tanggapan','id_teknisi','status','foto_bukti'
    ];
}
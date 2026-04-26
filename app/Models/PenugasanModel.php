<?php

namespace App\Models;

use CodeIgniter\Model;

class PenugasanModel extends \CodeIgniter\Model {
    protected $table = 'penugasan';
    protected $primaryKey = 'id_penugasan';
    
    // id_pengaduan sebagai relasi ke laporan, id_teknisi sebagai relasi ke user eksekutor
    protected $allowedFields = [
        'id_pengaduan', 'id_tanggapan', 'id_teknisi', 'status', 'foto_bukti'
    ];
}
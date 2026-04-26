<?php

namespace App\Models;

use CodeIgniter\Model;

class TanggapanModel extends \CodeIgniter\Model {
    protected $table = 'tanggapan';
    protected $primaryKey = 'id_tanggapan';
    
    // isi_tanggapan berisi teks respon, foto berisi bukti foto setelah pengerjaan/tanggapan
    protected $allowedFields = [
        'id_pengaduan', 'id_user', 'isi_tanggapan', 'foto'
    ];
}
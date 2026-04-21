<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $allowedFields = [
        'id_user','id_jenis','judul','deskripsi','lokasi','foto','status', 'alasan_ditolak',

   // SLA FEATURE
    'kategori',
    'deadline',
    'status_sla'
];

    

}
<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';
    
    // Mengizinkan penyimpanan data dasar laporan 
    protected $allowedFields = [
        'id_user', 'judul', 'deskripsi', 'lokasi', 'foto', 'status', 'alasan_ditolak'

        
    ];
}
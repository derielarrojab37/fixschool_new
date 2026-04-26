<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';
    
    // Mengizinkan penyimpanan data dasar laporan dan kolom tambahan untuk manajemen SLA
    protected $allowedFields = [
        'id_user', 'id_jenis', 'judul', 'deskripsi', 'lokasi', 'foto', 'status', 'alasan_ditolak',

        // Fitur SLA: kategori (prioritas), deadline (batas waktu), status_sla (on-time/late)
        'kategori',
        'deadline',
        'status_sla'
    ];
}
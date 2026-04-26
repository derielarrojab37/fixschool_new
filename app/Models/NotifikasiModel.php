<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends \CodeIgniter\Model {
    // Menentukan tabel target: notifikasi
    protected $table = 'notifikasi';
    
    protected $primaryKey = 'id_notifikasi';
    
    // id_user untuk target penerima, pesan untuk isi notif, status untuk (sudah/belum dibaca)
    protected $allowedFields = ['id_user', 'pesan', 'status', 'foto'];
}
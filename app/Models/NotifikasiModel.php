<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends \CodeIgniter\Model {
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    protected $allowedFields = ['id_user','pesan','status','foto'];
}
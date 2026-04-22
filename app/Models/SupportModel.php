<?php

namespace App\Models;

use CodeIgniter\Model;

class SupportModel extends Model
{
    protected $table = 'support';
    protected $primaryKey = 'id_support';

    protected $allowedFields = [
        'id_user',
        'judul',
        'pesan',
        'status',
        'created_at'
    ];

}
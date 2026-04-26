<?php

namespace App\Models;

use CodeIgniter\Model;

class SupportReplyModel extends Model
{
    protected $table = 'support_reply';
    protected $primaryKey = 'id_reply';

    // id_support menghubungkan balasan ini ke tiket utama yang ada di tabel support
    protected $allowedFields = [
        'id_support',
        'id_user',
        'pesan'
    ];
}
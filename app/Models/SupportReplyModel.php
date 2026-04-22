<?php

namespace App\Models;

use CodeIgniter\Model;

class SupportReplyModel extends Model
{
    protected $table = 'support_reply';
protected $primaryKey = 'id_reply';

protected $allowedFields = [
    'id_support',
    'id_user',
    'pesan'
];
}
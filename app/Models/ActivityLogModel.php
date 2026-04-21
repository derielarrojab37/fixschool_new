<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_log';
    protected $primaryKey = 'id_log';
    protected $allowedFields = ['id_user', 'aktivitas', 'waktu'];
}
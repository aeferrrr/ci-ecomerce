<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table      = 'akun';
    protected $primaryKey = 'id_akun';

    protected $useAutoIncrement = false;
    // Dates
    protected $useTimestamps = true;

    protected $allowedFields = [
        'id_akun',
        'id_alamat',
        'id_role',
        'id_status',
        'email',
        'password',
        'nama',
        'telp',
        'created_at',
        'updated_at',
    ];

}
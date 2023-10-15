<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatModel extends Model
{
    protected $table      = 'alamat';
    protected $primaryKey = 'id_alamat';

    protected $useAutoIncrement = true;
    // Dates
    protected $useTimestamps = true;

    protected $allowedFields = [
        'id_alamat ',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'created_at',
        'updated_at',
    ];
}
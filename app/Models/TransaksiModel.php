<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $allowedFields = [
        'id_transaksi',
        'id_akun',
        'total_harga',
        'resi',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
}

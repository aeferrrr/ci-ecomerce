<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_transaksi',
        'id_akun',
        'id_ekspedisi',
        'resi',
        'total_harga',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $useAutoIncrement = true;
    protected $useTimestamps = true;

    protected $allowedFields = [
        'id_transaksi',
        'id_akun',
        'id_ekspedisi',
        'id_alamat',
        'resi',
        'total_harga',
        'created_at',
        'updated_at',
    ];

    // Dates

}

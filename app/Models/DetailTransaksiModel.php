<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table      = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_detail_transaksi',
        'id_transaksi',
        'id_produk',
        'qty',
        'catatan',
        'total',
    ];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table      = 'keranjang';
    protected $primaryKey = 'id_keranjang';

    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'id_keranjang',
        'id_akun',
        'id_produk',
        'qty',
    ];
}

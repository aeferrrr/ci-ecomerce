<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id_produk';

    protected $useAutoIncrement = true;
    // Dates
    protected $useTimestamps = true;

    protected $allowedFields = [
        'id_produk',
        'id_kategori',
        'sku',
        'nama_produk',
        'gambar_produk',
        'deskripsi',
        'stok',
        'berat',
        'created_at',
        'updated_at',
    ];

}
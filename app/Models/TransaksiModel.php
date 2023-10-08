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

    //validation
    protected $validationRules = [
        'total_harga'        => 'required',
        'resi'        => 'required|max_length[64]|alpha_numeric'
    ];
    protected $validationMessages = [
        'total_harga' => [
            'required' => 'Mohon mengisi kolom Total Harga',
        ],
        'resi' => [
            'required' => 'Mohon mengisi kolom Resi',
            'max_length' => 'Tidak Dapat melebihi 64 karakter',
            'alpha_numeric' => 'Kolom harus berupa huruf dan angka',
        ],
    ];
}

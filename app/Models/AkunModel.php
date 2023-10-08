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

    protected $validationRules = [
        'email'     =>'required',
        'password'     =>'required|alpha|max_length[32]|min_length[8]',
        'nama'     =>'required|alpha_space|max_length[64]',
        'telp'     =>'max_length[13]|numeric',
    ];

    protected $validationMessages = [
        'email' => [
            'required'      => 'Mohon mengisi kolom Email',
        ],
        'password' => [
            'required'      => 'Password tidak boleh kosong',
            'min_length'    => 'Karakter tidak boleh kurang dari 8 karakter',
            'max_length'    => 'Karakter tidak boleh lebih dari 25 karakter'
        ],
        'nama' => [
            'required'      => 'Mohon mengisi kolom Nama',
            'alpha_space'   => 'Kolom harus berupa huruf',
            'max_length'    => 'Karakter tidak boleh lebih dari 64 huruf',
        ],
        'telp' => [
            'numeric'       => 'Kolom harus berupa angka',
            'max_length'    => 'Karakter tidak boleh lebih dari 13 angka',
        ],
    ];

}
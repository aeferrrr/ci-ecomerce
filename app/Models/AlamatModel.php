<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatModel extends Model
{
    protected $table      = 'alamat';
    protected $primaryKey = 'id_alamat';

    protected $useAutoIncrement = false;
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
    ];

    protected $validationRules = [
        'alamat'     =>'required|max_length[255]|alpha_numeric_punct',
        'provinsi'     =>'required|max_length[32]|alpha_numeric',
        'kota'     =>'required|max_length[32]|alpha_numeric',
        'kecamatan'     =>'required|max_length[32]|alpha_numeric',
        'kelurahan'     =>'required|max_length[32]|alpha_numeric',
        'kode_pos'     =>'required|max_length[5]|numeric',
        
    ]

    protected $validationMessages = [
        'alamat' => [
            'required'      => 'Mohon mengisi kolom Alamat',
            'alpha_numeric_punct' => 'Kolom harus berupa huruf, angka, dan simbol',
            'max_length'    => 'Karakter tidak boleh lebih dari 255 huruf',
        ],
        'provinsi' => [
            'required'      => 'Mohon mengisi kolom Provinsi',
            'alpha_numeric' => 'Kolom harus berupa huruf dan angka',
            'max_length'    => 'Karakter tidak boleh lebih dari 32 huruf',
        ],
        'kota' => [
            'required'      => 'Mohon mengisi kolom Kota',
            'alpha_numeric' => 'Kolom harus berupa huruf dan angka',
            'max_length'    => 'Karakter tidak boleh lebih dari 32 huruf',
        ],
        'kecamatan' => [
            'required'      => 'Mohon mengisi kolom Kecamatan',
            'alpha_numeric' => 'Kolom harus berupa huruf dan angka',
            'max_length'    => 'Karakter tidak boleh lebih dari 32 huruf',
        ],
        'kelurahan' => [
            'required'      => 'Mohon mengisi kolom kelurahan',
            'alpha_numeric' => 'Kolom harus berupa huruf dan angka',
            'max_length'    => 'Karakter tidak boleh lebih dari 32 huruf',
        ],
        'kode_pos' => [
            'required'      => 'Mohon mengisi kolom Kode Pos',
            'numeric' => 'Kolom harus berupa angka',
            'max_length'    => 'Karakter tidak boleh lebih dari 5 angka',
        ],
    ];

}
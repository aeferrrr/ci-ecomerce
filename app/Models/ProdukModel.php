<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id_produk';

    protected $useAutoIncrement = false;
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

    protected $validationRules = [
        'sku'     =>'required|alpha_numeric',
        'nama_produk'     =>'required|alpha|max_length[25]|is_unique[produk.nama_produk]',
        'deskripsi'     =>'required|alpha_numeric_punct|max_length[255]',
        'stok'     =>'required',
        'berat'     =>'required|max_length[15]',
    ];

    protected $validationMessages = [
        'sku' => [
            'required'      => 'Mohon mengisi kolom Sku',
            'alpha_numeric' => 'Kolom harus berupa huruf dan angka',
        ],
        'nama_produk' => [
            'required' => 'Mohon mengisi kolom Nama Produk',
            'alpha' => 'Kolom harus berupa Huruf A-Z',
            'max_length' => 'Karakter tidak boleh lebih dari 25 huruf',
            'is_unique' => 'Maaf, Produk sudah terdaftar',
        ],
        'deskripsi' => [
            'required' => 'Mohon mengisi kolom Deskripsi',
            'alpha_numeric_punct' => 'Kolom harus berupa Huruf dan Angka',
            'max_length' => 'Karakter tidak boleh lebih dari 255 huruf',
        ],
        'stok' => [
            'required' => 'Mohon mengisi kolom Stok'
        ],
        'berat' => [
            'required' => 'Mohon mengisi kolom Berat Produk'
        ],
    ];

}
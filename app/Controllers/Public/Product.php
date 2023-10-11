<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;

class Product extends BaseController
{
    protected $produkModel;
    protected $detailtransaksiModel;

    public function index($id_produk)
{   $produk = base64_decode($id_produk);
    $data = [
        'produk' => $this->produkModel
            ->join('kategori', 'produk.id_kategori = kategori.id_kategori')
            ->where('id_produk', $produk)
            ->findAll(),
        'penjualan' => $this->detailtransaksiModel
        ->join('produk', 'detail_transaksi.id_produk = produk.id_produk')
        ->where('produk.id_produk', $produk)
        ->countAllResults(),
    ];

    return view('public/detail_produk', $data);
}

    
}
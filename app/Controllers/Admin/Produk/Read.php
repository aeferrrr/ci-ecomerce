<?php

namespace App\Controllers\Admin\Produk;

use \App\Controllers\BaseController;

class Read extends BaseController
{
    protected $produkModel;

    public function index()
    {
        $produk =  $this->produkModel
        ->join('kategori', 'kategori.id_kategori = produk.id_kategori')
        ->findAll();
        $data =
            [
                'title'     => 'Koperasi - List Produk',
                'produk' => $produk
            ];
        return view('admin/produk/read', $data);
    }
}
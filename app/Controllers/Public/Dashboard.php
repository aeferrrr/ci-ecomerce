<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $produkModel;

    public function index()
    {
        $data =
        [
        'produk' => $this->produkModel
                ->join('kategori', 'produk.id_kategori = kategori.id_kategori')
                ->findAll(), 
        'keranjang' => $this->keranjangModel
                ->join('akun', 'keranjang.id_akun = akun.id_akun')
                ->where('keranjang.id_akun', session('id_akun'))
                ->countAllResults(),
            ]; 

        return view('public/dashboard', $data);
    }
    
}
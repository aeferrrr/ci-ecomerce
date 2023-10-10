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
            ]; 

        return view('public/dashboard', $data);
    }
    
}
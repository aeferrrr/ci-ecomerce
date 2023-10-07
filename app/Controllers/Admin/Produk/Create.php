<?php

namespace App\Controllers\Admin\Produk;

use \App\Controllers\BaseController;

class Create extends BaseController
{
    public function index (){
        return view('admin/produk/create');
    }
}
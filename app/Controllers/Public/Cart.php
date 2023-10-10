<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;

class Cart extends BaseController
{
    public function index()
    {
        return view('public/cart');
    }
    
}
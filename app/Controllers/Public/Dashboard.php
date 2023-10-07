<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('public/dashboard');
    }
}
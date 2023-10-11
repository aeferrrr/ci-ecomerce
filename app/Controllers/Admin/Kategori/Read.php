<?php

namespace App\Controllers\Admin\Kategori;

use \App\Controllers\BaseController;

class Read extends BaseController
{
    protected $kategoriModel;

    public function index()
    {
        $data =
            [
                'title'     => 'Koperasi - Brand List',
                'kategori'     => $this->kategoriModel->findAll(),
            ];
        return view('admin/kategori/read', $data);
    }
}
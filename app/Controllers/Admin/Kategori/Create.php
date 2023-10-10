<?php

namespace App\Controllers\Admin\Kategori;

use \App\Controllers\BaseController;

class Create extends BaseController
{
    protected $kategoriModel;

    public function index()
    {
        if (!$this->request->is('post')) {
            $data =
                [
                    'title'     => 'Admin - Tambah Kategori',
                ];
            return view('admin/kategori/create', $data);
        }


        $this->kategoriModel->save(
            [
                'nama_kategori' => $this->request->getVar('nama_kategori'),
            ]
        );

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->back()->withInput();
    }
}
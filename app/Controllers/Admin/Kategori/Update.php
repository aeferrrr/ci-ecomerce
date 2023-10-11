<?php

namespace App\Controllers\Admin\Kategori;

use \App\Controllers\BaseController;

class Update extends BaseController
{
    protected $kategoriModel;

    public function index($id)
    {
        if (!$this->request->is('post')) {
            $getKategori = $this->kategoriModel->find($id);
            $data =
                [
                    'title'     => 'Koperasi - Edit Kategori',
                    'kategori'     => $getKategori,
                ];
            return view('admin/kategori/update', $data);
        }

        $this->kategoriModel->save(
            [
                'id_kategori' => $id,
                'nama_kategori' => $this->request->getVar('nama_kategori'),
            ]
        );

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->back()->withInput();
    }
}
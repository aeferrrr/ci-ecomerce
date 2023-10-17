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

        // Manual validation
        $validationRules = [
            'nama_kategori' => 'required|is_unique[kategori.nama_kategori]|alpha_space|max_length[25]',
            // Add more validation rules as needed
        ];

        $validationMessages = [
            'nama_kategori' => [
                'required' => 'Nama Kategori Harus Terisi',
                'is_unique' => 'Nama Kategori Sudah Ada',
                'alpha_space' => 'Kolom harus berupa huruf',
                'max_length' => 'Kolom Kategori Tidak Lebih Dari 25 Huruf',
                // Add more custom error messages as needed
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->to('admin/kategori/update/' . $id)->withInput()->with('validation', $this->validator);
        }

        // Data passed validation, so save it
        $this->kategoriModel->save([
            'id_kategori' => $id,
            'nama_kategori' => $this->request->getVar('nama_kategori'),
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->back()->withInput();
    }
}
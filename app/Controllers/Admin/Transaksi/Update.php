<?php

namespace App\Controllers\Admin\Transaksi;

use \App\Controllers\BaseController;

class Update extends BaseController
{
    protected $transaksiModel;

    public function index($id)
    {
        if (!$this->request->is('post')) {
            $getTransaksi = $this->transaksiModel->find($id);
            $data =
                [
                    'title'     => 'Admin - Perbarui Resi',
                    'resi'     => $getTransaksi,
                ];
            return view('admin/transaksi/update', $data);
        }

        // Manual validation
        $validationRules = [
            'resi' => 'required|is_unique[transaksi.resi]|numeric|max_length[64]',
            // Add more validation rules as needed
        ];

        $validationMessages = [
            'resi' => [
                'required' => 'Kolom harus terisi',
                'is_unique' => 'Resi telah terdaftar di transaksi lain',
                'numeric' => 'Kolom harus berupa angka',
                'max_length' => 'Kolom Tidak Lebih Dari 64 Angka',
                // Add more custom error messages as needed
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->to('admin/transaksi/update/' . $id)->withInput()->with('validation', $this->validator);
        }

        // Data passed validation, so save it
        $this->transaksiModel->save([
            'id_transaksi' => $id,
            'resi' => $this->request->getVar('resi'),
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->back()->withInput();
    }
}
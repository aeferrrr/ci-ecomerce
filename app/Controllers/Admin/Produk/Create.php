<?php

namespace App\Controllers\Admin\Produk;

use \App\Controllers\BaseController;

class Create extends BaseController
{
    protected $kategoriModel;
    protected $produkModel;

    public function index()
    {
        if (!$this->request->is('post')) {
            $data =
                [
                    'title'     => 'Koperasi - Tambah Produk',
                    'kategori'  => $this->kategoriModel->findAll(),
                ];
            return view('admin/produk/create', $data);
        }


       // Validasi form
    $validation = \Config\Services::validation();
    $rules = [
        // 'nama_produk' => 'required',
        // 'harga' => 'required',
        // tambahkan validasi lainnya sesuai kebutuhan
    ];

    if (!$this->validate($rules)) {
        $data['validation'] = $validation;
        return view('admin/produk/create', $data);
    } else {
        // Proses input data

        // Proses unggahan gambar
        $gambarProduk = $this->request->getFile('gambar_produk');
        if ($gambarProduk->isValid() && !$gambarProduk->hasMoved()) {
            $newName = $gambarProduk->getRandomName();
            $gambarProduk->move('path_to_your_image_directory', $newName);

            // Simpan nama gambar ke database (jika perlu)
            $gambarProdukName = $newName;
        }

        // Simpan data ke database (contoh)
        $produkData = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            // tambahkan data lainnya
            'gambar_produk' => $gambarProdukName, // Simpan nama gambar ke database
        ];

        // Lakukan penyimpanan data ke database

        return redirect()->to('admin/produk')->with('success', 'Produk berhasil disimpan');
    }
    }
}
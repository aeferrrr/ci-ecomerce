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
            $data = [
                'title' => 'Admin - Tambah Produk',
                'kategori' => $this->kategoriModel->findAll(),
            ];
            return view('admin/produk/create', $data);
        }
        $newFileName = ''; // Inisialisasi dengan nilai default kosong
        $validation = \Config\Services::validation();
        // Manual validation
        $validationRules = [
            'id_kategori' => 'required',
            'sku' => 'required|numeric|max_length[11]',
            'nama_produk' => 'required|alpha_numeric_punct|max_length[25]|is_unique[produk.nama_produk]',
            'harga' => 'required|numeric|greater_than_equal_to[0]',
            'stok' => 'required|numeric|greater_than_equal_to[0]',
            'berat' => 'required|numeric',
            'deskripsi' => 'required',
        ];

        $validationMessages = [
            'id_kategori' => [
                'required' => 'Kolom Harus Terisi',
                // Add more custom error messages as needed
            ],
            'sku' => [
                'required' => 'Kolom Harus Terisi',
                'numeric' => 'Kolom Harus Berupa Angka',
                'max_length' => 'Kolom SKU Tidak Lebih Dari 11 Angka',
                // Add more custom error messages as needed
            ],
            'nama_produk' => [
                'required' => 'Kolom Harus Terisi',
                'max_length' => 'Kolom tidak boleh lebih dari 25 huruf',
                'is_unique' => 'Maaf, produk sudah terdaftar',
                // Add more custom error messages as needed
            ],
            'harga' => [
                'required' => 'Kolom Harus Terisi',
                'numeric' => 'Kolom Harus Berupa Angka',
                'greater_than_equal_to' => 'Minimun angka adalah 0'
                // Add more custom error messages as needed
            ],
            'stok' => [
                'required' => 'Kolom Harus Terisi',
                'numeric' => 'Kolom Harus Berupa Angka',
                'greater_than_equal_to' => 'Minimun angka adalah 0'
                // Add more custom error messages as needed
            ],
            'berat' => [
                'required' => 'Kolom Harus Terisi',
                'numeric' => 'Kolom Harus Berupa Angka',
                // Add more custom error messages as needed
            ],

        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->to('admin/produk/create')->withInput()->with('validation', $this->validator);
        }

        // ...

        $gambarProduk = $this->request->getFile('gambar_produk');

        // Validasi apakah file gambar diunggah
        if (!$gambarProduk->isValid()) {
            return redirect()->to('admin/produk/create')->with('error', 'Anda harus mengunggah gambar produk.');
        }
        
        // Validasi tipe berkas
        if (!in_array($gambarProduk->getClientExtension(), ['jpg', 'jpeg', 'png', 'JPG', 'PNG', 'JPEG'])) {
            return redirect()->to('admin/produk/create')->with('error', 'File harus berupa JPG, JPEG, atau PNG.');
        }
        
        // Validasi ukuran maksimum (2 MB)
        if ($gambarProduk->getSize() > 2 * 1024 * 1024) { // 2 MB in bytes
            return redirect()->to('admin/produk/create')->with('error', 'Ukuran file harus kurang dari 2 MB.');
        }
        
        // Unsur kode lainnya
        $newFileName = $gambarProduk->getRandomName();
        $gambarProduk->move(ROOTPATH . 'public/uploads', $newFileName);


        $produkData = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'sku' => $this->request->getPost('sku'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
            'berat' => $this->request->getPost('berat'),
            'gambar_produk' => $newFileName,
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        $this->produkModel->insert($produkData);

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('admin/produk/create');
    }
}

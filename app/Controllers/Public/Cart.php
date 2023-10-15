<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Cart extends BaseController

{
    protected $ProdukModel;
    protected $keranjangModel;
    public function index()
{
    $apiKey = '2d0c536fb8b9498938cb3479dbfb435c'; // Gantilah dengan API Key Anda
    $provinceId = 6.5; // Gantilah dengan ID provinsi yang sesuai

    $url = "https://api.rajaongkir.com/starter/city?province=$provinceId";

    $headers = [
        'key: ' . $apiKey,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $cities = [];
    if ($response) {
        $cities = json_decode($response, true);
        // Proses data kota dan tampilkan di halaman web
    }

    $data = [
        'keranjang' => $this->keranjangModel
            ->join('produk', 'keranjang.id_produk = produk.id_produk')
            ->where('id_akun', session('id_akun'))
            ->findAll(),
        'cities' => $cities, // Menambahkan data kota ke variabel $data
    ];

    return view('public/cart', $data);
}

    public function delete()
    {
        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'id_keranjang' => 'required',
            ];
            $id_keranjang = $this->request->getPost('id_keranjang');
            if (!$this->validate($validationRules)) {
                $errors = $this->validator->getErrors();
                session()->setFlashdata('error', $errors);
                return redirect()->back();
            }
            $decodedIdKeranjang = base64_decode($id_keranjang);
            $this->keranjangModel->delete($decodedIdKeranjang);
            session()->setFlashdata('success', 'Produk berhasil dihapus.');
            return redirect()->back();
        }
    }
    
    public function add()
{
    // Periksa jika metode permintaan adalah 'POST'
    if ($this->request->getMethod() === 'post') {
        // Aturan validasi
        $validationRules = [
            'id_akun' => 'required',
            'id_produk' => 'required',
            'jumlah_produk' => 'required',
        ];

        // Ambil data dari permintaan POST
        $id_akun = $this->request->getPost('id_akun');
        $id_produk = $this->request->getPost('id_produk');
        $jumlah_produk = $this->request->getPost('jumlah_produk');
        $catatan = $this->request->getPost('catatan');

        // Validasi data
        if (!$this->validate($validationRules)) {
            $errors = $this->validator->getErrors();
            session()->setFlashdata('error', $errors);
            return redirect()->back();
        }

        // Decode 'id_produk'
        $produk = base64_decode($id_produk);

        $existingData = $this->keranjangModel->where('id_akun', $id_akun)
                                         ->where('id_produk', $produk)
                                         ->first();

    if ($existingData) {
        $newQty = $existingData['qty'] + $jumlah_produk;   
        $this->keranjangModel->where('id_keranjang', $existingData['id_keranjang'])
                            ->set('qty', $newQty)
                            ->update();
        session()->setFlashdata('success', 'Produk berhasil ditambahkan.');
        return redirect()->back();
    } else {

        $data = [
            'id_akun' => $id_akun,
            'id_produk' => $produk,
            'qty' => $jumlah_produk,
            'catatan' => $catatan,
        ];
        $this->keranjangModel->insert($data);
        session()->setFlashdata('success', 'Produk berhasil ditambahkan.');
        return redirect()->back();
    }
}

}
public function update()
{
    $productId = $this->request->getPost('product_id');
    $newQty = $this->request->getPost('new_qty');

    // Cari data keranjang berdasarkan id_produk
    $existingData = $this->keranjangModel
        ->where('id_produk', $productId)
        ->first();

    if ($existingData) {
        // Produk ditemukan dalam keranjang
        $qtybaru = $newQty;

        $this->keranjangModel
            ->where('id_produk', $productId)
            ->set('qty', $qtybaru)
            ->update();

        session()->setFlashdata('success', 'Produk berhasil diperbarui.');
    } else {
        // Produk tidak ditemukan dalam keranjang, tambahkan produk ke keranjang.
        $data = [
            'id_produk' => $productId,
            'qty' => $newQty
        ];

        $this->keranjangModel->insert($data);

        session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    return redirect()->back();
}


}
<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use GuzzleHttp\Client;

class Transaction extends BaseController
{
    protected $transaksiModel;
    protected $detailtransaksiModel;

    public function add()
    {
        $id_akun = $this->request->getPost('id_akun');
        $decodeidakun = base64_decode($id_akun);

        if ($decodeidakun) {
            // Inisialisasi objek Client untuk HTTP request
            $apiKey = '2d0c536fb8b9498938cb3479dbfb435c'; // Gantilah dengan API key RajaOngkir yang Anda miliki
            $curl = new Client();

            // Mendapatkan data provinsi
            $response = $curl->request('GET', 'https://api.rajaongkir.com/starter/province', [
                'headers' => [
                    'key' => $apiKey,
                ],
            ]);
            $provinces = json_decode($response->getBody(), true);

            $data = [
                'akun' => $this->akunModel
                    ->where('id_akun', $decodeidakun)
                    ->First(),
                'keranjang' => $this->keranjangModel
                    ->join('produk', 'keranjang.id_produk = produk.id_produk')
                    ->where('id_akun', $decodeidakun)
                    ->findAll(),
                'alamat' => $this->alamatModel
                    ->join('akun', 'alamat.id_alamat = akun.id_alamat')
                    ->where('akun.id_akun', $decodeidakun)
                    ->first(),
                'provinsi' => $provinces,
            ];

            return view('public/checkout', $data);
        } else {
            return redirect()->to('/error-page');
        }
    }
    
    
    public function getCityData($province_id)
    {
        $apiKey = '2d0c536fb8b9498938cb3479dbfb435c'; // Gantilah dengan API key RajaOngkir yang Anda miliki
    
        $client = \Config\Services::curlrequest();
    
        // Mendapatkan data kota
        $response = $client->request('GET', "https://api.rajaongkir.com/starter/city?province=$province_id", [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);
    
        if ($response->getStatusCode() !== 200) {
            return $this->fail('API request failed with HTTP code: ' . $response->getStatusCode());
        }
    
        $cities = json_decode($response->getBody(), true);
    
        if (empty($cities) || !is_array($cities)) {
            return $this->fail('Failed to parse API response.');
        }
    
        // Menggunakan metode json() untuk mengirim respons dalam format JSON
        return $this->response->setJSON($cities);
    }  

    // Di dalam Controller Anda
    public function checkout()
    {
        $idAkun = $this->request->getPost('id_akun');
        $idAkunDecoded = base64_decode($idAkun);
        $total_pembayaran = $this->request->getPost('total-pembayaran1');
        $kurir = $this->request->getPost('courier');
        if ($kurir === 'jne') {
            $nilaiKurir = 1;
        } elseif ($kurir === 'tiki') {
            $nilaiKurir = 2;
        } elseif ($kurir === 'pos') {
            $nilaiKurir = 3;
        } else {
            $nilaiKurir = 0;
        }
        $products = $this->request->getPost('products');


        $transaksi = [
                'id_akun' => $idAkunDecoded,
                'id_ekspedisi' => $nilaiKurir,
                'total_harga' => $total_pembayaran,
        ];
        $this->transaksiModel->insert($transaksi);

        $transaksiId = $this->transaksiModel->getInsertID();

        foreach ($products as $index => $product) {
            $idProduk = $product['id'];
            $qty = $product['qty'];
            $catatan = $product['catatan'];
            $hasilPerkalian = $product['total'];
        $detailtransaksi =[
            'id_transaksi' => $transaksiId,
            'id_produk' => $idProduk,
            'qty' => $qty,
            'catatan' => $catatan,
            'total' => $hasilPerkalian,
        ];
        $this->detailtransaksiModel->insert($detailtransaksi);
        }

        $idtransaksiencode = base64_encode($transaksiId);
        return redirect()->to(base_url('/transaction/payment/' . $idtransaksiencode));
    }
    
    
    
    public function payment($id_transaksi)
    {
        $decodeidtransaksi = base64_decode($id_transaksi);
        $data = [
            'transaksi' => $this->transaksiModel
                ->join('akun', 'transaksi.id_akun = akun.id_akun')
                ->where('transaksi.id_transaksi', $decodeidtransaksi)
                ->first(),
        ];
    
        return view('public/payment', $data);
    }
    

}

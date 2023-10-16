<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use GuzzleHttp\Client;

class Transaction extends BaseController
{
    protected $transaksiModel;
    protected $detailtransaksiModel;
    protected $alamatModel;
    protected $produkModel;
    protected $keranjangModel;

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
        $alamat = $this->request->getPost('alamat');
        $kecamatan = $this->request->getPost('kecamatan');
        $kodepos = $this->request->getPost('kodepos');
        $kelurahan = $this->request->getPost('kelurahan');
        $provinsi = $this->request->getPost('selectedProvince');
        $kota = $this->request->getPost('city_name');
        
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

    
        $keranjang = $this->keranjangModel->where('id_akun', $idAkunDecoded)->findAll();
        $idsToDelete = [];
        foreach ($keranjang as $item) {
            $idsToDelete[] = $item['id_keranjang'];
        }
        if (!empty($idsToDelete)) {
            $this->keranjangModel->delete($idsToDelete);
        }


        
        $alamat = [
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'kode_pos' => $kodepos,

        ];
        $this->alamatModel->insert($alamat);
        $alamatId = $this->alamatModel->getInsertID();

        $transaksi = [
                'id_akun' => $idAkunDecoded,
                'id_ekspedisi' => $nilaiKurir,
                'id_alamat' => $alamatId,
                'total_harga' => $total_pembayaran,
        ];
        $this->transaksiModel->insert($transaksi);

        $transaksiId = $this->transaksiModel->getInsertID();

        foreach ($products as $index => $product) {
            $idProduk = $product['id'];
            $qty = $product['qty'];
            $catatan = $product['catatan'];
            $hasilPerkalian = $product['total'];
        
            // Simpan detail transaksi
            $detailtransaksi = [
                'id_transaksi' => $transaksiId,
                'id_produk' => $idProduk,
                'qty' => $qty,
                'catatan' => $catatan,
                'total' => $hasilPerkalian,
            ];
            $this->detailtransaksiModel->insert($detailtransaksi);
        
            // Kurangi stok produk
            $produk = $this->produkModel->where('id_produk', $idProduk)->first();
            if ($produk) {
                $newQty = $produk['stok'] - $qty;
                $this->produkModel->where('id_produk', $produk['id_produk'])
                    ->set('stok', $newQty)
                    ->update();
            }
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
    
    public function history()
    {
        $idAkun = $this->request->getPost('id_akun');
        $idAkunDecoded = base64_decode($idAkun);
    
        // Mengambil data transaksi berdasarkan ID akun
        $transaksi = $this->transaksiModel
            ->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi')
            ->join('alamat', 'transaksi.id_alamat = alamat.id_alamat')
            ->join('akun', 'transaksi.id_akun = akun.id_akun')
            ->join('produk', 'detail_transaksi.id_produk = produk.id_produk')
            ->where('transaksi.id_akun', $idAkunDecoded)
            ->findAll();
    
        // Mengatur ulang data transaksi dan mengelompokkan item per transaksi
        $data =
         [];
        foreach ($transaksi as $tr) {
            $transaksiId = $tr['id_transaksi'];
    
            // Jika transaksiId belum ada dalam $data, tambahkan sebagai indeks baru
            if (!array_key_exists($transaksiId, $data)) {
                $data[$transaksiId] = [
                    'id_transaksi' => $tr['id_transaksi'],
                    'tanggal_pengiriman' => $tr['updated_at'],
                    'items' => [],
                ];
            }
    
            // Tambahkan item ke dalam transaksi
            $data[$transaksiId]['items'][] = [
                'gambar_produk' => $tr['gambar_produk'],
                'nama_produk' => $tr['nama_produk'],
                'catatan' => $tr['catatan'],
                'total' => $tr['total'],
                'total_harga' => $tr['total_harga'],
                'resi' => $tr['resi'],
            ];
        }
        $alamat = $this->transaksiModel
        ->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi')
        ->join('alamat', 'transaksi.id_alamat = alamat.id_alamat')
        ->join('akun', 'transaksi.id_akun = akun.id_akun')
        ->where('transaksi.id_akun', $idAkunDecoded)
        ->findAll();

    
        return view('public/history', ['transaksi' => $data, 'alamat' => $alamat]);
    }
    

}

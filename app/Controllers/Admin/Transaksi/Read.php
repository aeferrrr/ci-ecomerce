<?php

namespace App\Controllers\Admin\Transaksi;

use \App\Controllers\BaseController;

class Read extends BaseController
{
    protected $produkModel;
    protected $alamatModel;
    protected $detailtransaksiModel;
    protected $transaksiModel;
    protected $akunModel;
    protected $ekspedisiModel;

    // public function index()
    // {
    //     $riwayat =  $this->transaksiModel
    //     ->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi')
    //     ->join('akun', 'akun.id_akun = transaksi.id_akun')
    //     ->join('ekspedisi', 'ekspedisi.id_ekspedisi = transaksi.id_ekspedisi')
    //     ->join('alamat', 'alamat.id_alamat = transaksi.id_alamat')
    //     ->join('produk', 'detail_transaksi.id_produk = produk.id_produk')
    //     ->findAll();
    //     $data =
    //         [
    //             'title'     => 'Koperasi - List Produk',
    //             'riwayat' => $riwayat
    //         ];
    //     return view('admin/transaksi/read', $data);
        
    // }

    public function index (){
    // Mengambil data transaksi berdasarkan ID akun
        $transaksi = $this->transaksiModel
            ->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi')
            ->join('alamat', 'transaksi.id_alamat = alamat.id_alamat')
            ->join('akun', 'transaksi.id_akun = akun.id_akun')
            ->join('ekspedisi', 'ekspedisi.id_ekspedisi = transaksi.id_ekspedisi')
            ->join('produk', 'detail_transaksi.id_produk = produk.id_produk')
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
                'qty' => $tr['qty'],
            ];
            
        }
        $alamat = $this->transaksiModel
        ->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi')
        ->join('alamat', 'transaksi.id_alamat = alamat.id_alamat')
        ->join('akun', 'transaksi.id_akun = akun.id_akun')
        ->findAll();


        return view('admin/transaksi/read', ['transaksi' => $data, 'alamat' => $alamat, 'title' => 'Admin - Tambah Produk']);
    }
}
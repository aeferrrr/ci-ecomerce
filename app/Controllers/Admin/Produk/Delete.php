<?php

namespace App\Controllers\Admin\Produk;

use \App\Controllers\BaseController;

class Delete extends BaseController
{
    protected $produkModel;

    public function index($id)
    {
        $this->produkModel->where('id_produk', $id)->delete();

        $response = [
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
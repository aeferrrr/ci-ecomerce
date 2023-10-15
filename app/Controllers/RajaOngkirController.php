<?php

namespace App\Controllers;

class RajaOngkirController extends BaseController
{
    public function getShippingCost()
    {
        $destination = $this->request->getVar('destination');
        $weight = $this->request->getVar('weight');
        $courier = $this->request->getVar('courier');

        // Set header untuk mengizinkan permintaan dari domain klien Anda (ganti "http://localhost:8080" dengan domain Anda)
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, x-requested-with");

        // Kirim permintaan ke API RajaOngkir
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=55&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 2d0c536fb8b9498938cb3479dbfb435c"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $this->response->setJSON(['error' => "cURL Error #: $err"]);
        } else {
            return $this->response->setJSON(json_decode($response));
        }
    }
}

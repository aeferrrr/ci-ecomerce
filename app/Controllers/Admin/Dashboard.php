<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $thisWeekMonday = date('Y-m-d', strtotime('this week'));
        $thisWeekSunday = date('Y-m-d', strtotime('this week +6 days'));


        $totalTransaksiHariIni = $this->transaksiModel
            ->where('DATE(created_at)', date('Y-m-d'))
            ->selectSum('total_harga')
            ->get()
            ->getRow()
            ->total_harga;
        $totalTransaksiBulanIni = $this->transaksiModel
            ->where('YEAR(created_at)', date('Y'))
            ->where('MONTH(created_at)', date('m'))
            ->selectSum('total_harga')
            ->get()
            ->getRow()
            ->total_harga;
        $totalTransaksiTahunIni = $this->transaksiModel
            ->where('YEAR(created_at)', date('Y'))
            ->selectSum('total_harga')
            ->get()
            ->getRow()
            ->total_harga;
        $totalTransaksiBulanan = $this->transaksiModel
            ->select('MONTH(created_at) as month, SUM(total_harga) as total_harga')
            ->where('created_at >=', date('Y-01-01'))
            ->where('created_at <=', date('Y-12-t'))
            ->groupBy('month')
            ->get()
            ->getResult();
        $totalTransaksiMingguIni = $this->transaksiModel
            ->where('created_at >=', $thisWeekMonday)
            ->where('created_at <=', $thisWeekSunday)
            ->selectSum('total_harga')
            ->get()
            ->getRow()
            ->total_harga;
    
        $data = [
            'title' => 'Koperasi - Dashboard',
            'transactiontoday' => $totalTransaksiHariIni,
            'transactionThisMonth' => $totalTransaksiBulanIni,
            'transactionThisYear' => $totalTransaksiTahunIni,
            'transactionMonthly' => $totalTransaksiBulanan,
            'transactionThisWeek' => $totalTransaksiMingguIni
            
        ];

        return view('admin/dashboard', $data);
    }

    
}
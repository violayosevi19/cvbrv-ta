<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\Stock;

class DashboardController extends Controller
{
    public function index() {
        $stock = Stock::pluck('stock','namaproduk');
        $stockMin = Stock::pluck('stock_minimum','namaproduk');
        // $productNames = $stock->keys();
        // dd($stockMin);
        $message = [];
        foreach($stock as $namaproduk => $stock){
            // dd($namaproduk);
            $cekStock = $stockMin[$namaproduk];
            // dd($cekStock);
            if ($stock <= $cekStock) {
                // Memicu peringatan atau melakukan tindakan sesuai kebutuhan
                $message[] = "Peringatan: Stok produk $namaproduk abis tu a!";
            } 
        }
        // return view('dashboard.dash.dashboard',[
        //     'produkstock' => $stock,
        //     'produkName' => $productNames,
        //     'stockMin' => $stockMin
        // ]);
        return view('dashboard.dash.dashboard',[
            'stockAlerts' => $message
        ]);
    }


}

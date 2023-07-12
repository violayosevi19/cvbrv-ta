<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class SearchingController extends Controller
{
    public function searchingStok(Request $request) {
        $hasil = Produk::where('stock','<','50')->get();
        // dd($hasil);
        return view('dashboard.produk.index',['produks'=>$hasil]);

    }

    public function searchingPenjualanperMonth(Request $request) {

    }

    public function searchingProdukperKategori(Request $request) {

    }


} 

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

    public function searchingProduk(Request $request) {
        $input = $request->input('inputSearch');
        // $input = "Ka";
        $produk = Produk::where('namaproduk','like' , '%' . $input . '%')->get();
        // dd($produk);
        return response()->json($produk);
    }

    public function searchingProdukperKategori(Request $request) {

    }


} 

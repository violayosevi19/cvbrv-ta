<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukHomeController extends Controller
{
     public function index(){
    	return view('home.produk.index',['produks' => Produk::all()]);
    }
}

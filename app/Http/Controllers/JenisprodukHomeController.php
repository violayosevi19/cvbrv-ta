<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenisproduk;

class JenisprodukHomeController extends Controller
{
     public function index(){
    	return view('home.jenisproduk.index',['jenisproduks' => Jenisproduk::all()]);
    }
}

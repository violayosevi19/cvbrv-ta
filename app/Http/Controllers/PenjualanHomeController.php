<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanHomeController extends Controller
{
     public function index(){
    	return view('home.penjualan.index',['penjualans' => Penjualan::all()]);
    }
}

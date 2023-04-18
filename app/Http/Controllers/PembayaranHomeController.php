<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranHomeController extends Controller
{
     public function index(){
    	return view('home.pembayaran.index',['pembayarans' => Pembayaran::all()]);
    }
}

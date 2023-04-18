<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detailpesanan;

class DetailpesananHomeController extends Controller
{
    public function index(){
    	return view('home.detailpesanan.index',['details' => Detailpesanan::all()]);
    }
}

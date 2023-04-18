<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;

class TokoHomeController extends Controller
{
     public function index(){
    	return view('home.toko.index',['tokos' => Toko::all()]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faktur;

class FakturHomeController extends Controller
{
     public function index(){
    	return view('home.faktur.index',['fakturs' => Faktur::all()]);
    }
}

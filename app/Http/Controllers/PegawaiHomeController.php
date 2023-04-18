<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiHomeController extends Controller
{
    public function index(){
    	return view('home.pegawai.index',['pegawais' => Pegawai::all()]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierHomeController extends Controller
{
     public function index(){
    	return view('home.supplier.index',['suppliers' => Supplier::all()]);
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\faktur;
use App\Models\detailpesanan;
use Illuminate\Http\Request;

class GetTotalController extends Controller
{
    public function getTotal(Request $request)
    {
        $nonota = $request->input('nonota');
        $total = detailpesanan::where('nonota', $nonota)->sum(\DB::raw('jumlah * harga'));

        return response()->json(['total' => $total]);
    }
}

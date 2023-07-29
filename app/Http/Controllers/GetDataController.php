<?php

namespace App\Http\Controllers;


use App\Models\faktur;
use App\Models\penjualan;
use App\Models\detailpesanan;
use App\Models\toko;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetDataController extends Controller
{
    public function getFaktur(Request $request)
    {
        $nonota = $request->input('nonota');
        // $nonota = 'C182301';
        $total = detailpesanan::select(DB::raw('sum(jumlah) as total_amount'))
        ->where('nonota', '=', $nonota)
        ->first('total_amount')->toArray()['total_amount'];

        $datafaktur = detailpesanan::select('namatoko','tglfaktur','jatuhtempo')
        ->where('nonota', '=', $nonota)
        ->first()->toArray();

        $namatoko = $datafaktur['namatoko'];
        $tglfaktur = $datafaktur['tglfaktur'];
        $jatuhtempo = $datafaktur['tglfaktur'];
        // dd($total,$namatoko,$tglfaktur,$jatuhtempo);

        return response()->json([
            'total' => $total,
            'namatoko' => $namatoko,
            'tglfaktur' => $tglfaktur,
            'jatuhtempo' => $jatuhtempo
        ]);
    }

    public function getAlamat(Request $request)
    {
        $namatoko = $request->input('namatoko');
        // $namatoko = 'Budiman';
        $getAlamat = toko::where('namatoko','like','%'. $namatoko .'%')->first('alamat');
        // dd($getAlamat);
        if($getAlamat) {
            $alamat = $getAlamat->alamat;
            // dd($alamat);
        } else {
            $alamat = "";
        }

        return response()->json(['alamat' => $alamat]);
    }

    public function getNamaProduk(Request $request)
    {
        $kodeproduk = $request->input('kodeproduk');
        $namaproduk = produk::where('kodeproduk', $kodeproduk)->first('namaproduk')->toArray()['namaproduk'];
        $hargaproduk = produk::where('kodeproduk',$kodeproduk)->first('harga')->toArray()['harga'];
        // dd($namaproduk, $hargaproduk);

        return response()->json([
            'namaproduk' => $namaproduk,
            'hargaproduk' => $hargaproduk
        ]);
    }

    public function getJumlahHargaProduk(Request $request) {
        $kuantitas = (int)$request->input('stock');
        $harga = (int)$request->input('harga');
        $diskon = (int)$request->input('diskon');
        // var_dump($kuantitas,$harga,$diskon);
        // $kuantitas = 12;
        // $harga = 5700;
        // $diskon = 0;
        $jumlahperproduk = $kuantitas * $harga - $diskon;
        // dd($jumlahperproduk);

        return response()->json([
            'jumlahharga' => $jumlahperproduk
        ]);
    }

    public function getJumlahHargaDetail(Request $request) {
        $kuantitas = (int)$request->input('kuantitas');
        $harga = (int)$request->input('harga');
        $diskon = (int)$request->input('diskon');
        // var_dump($kuantitas,$harga,$diskon);
        // $kuantitas = 12;
        // $harga = 5700;
        // $diskon = 0;
        $jumlahperproduk = $kuantitas * $harga - $diskon;
        // dd($jumlahperproduk);

        return response()->json([
            'jumlahharga' => $jumlahperproduk
        ]);
    }

    public function getPenjualan(Request $request) {
        $nonota = $request->input('nonota');
        // $nonota = 'C182301';
        $takeFaktur = faktur::select('namatoko','total')->where('nonota', $nonota)->first();
        if($takeFaktur) {
            $namatoko = $takeFaktur->namatoko;
            $total = $takeFaktur->total;
        } else {
            $namatoko = "";
            $total = "";
        }
        // dd($takeFaktur,$namatoko,$total);
        return response()->json([
            'namatoko' => $namatoko,
            'total' => $total
        ]);
    }

    public function getPenjualanFromChecked(Request $request) {
        $nonota = $request->input('nonota');
        // $nonota = 'C182301';
        $fakturNonota = faktur::where('nonota',$nonota)->first();
        // dd($fakturNonota);

        $fakturNonota->update(['status_diterima' => 1]);
        
        $penjualan = new penjualan();
        $penjualan->nonota = $fakturNonota->nonota;
        $penjualan->namatoko = $fakturNonota->namatoko;
        $penjualan->totalpenjualan = $fakturNonota->total;
        $penjualan->save();

        return response()->json(['success' => true]);

    }

}

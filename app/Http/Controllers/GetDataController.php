<?php

namespace App\Http\Controllers;


use App\Models\faktur;
use App\Models\penjualan;
use App\Models\detailpesanan;
use App\Models\toko;
use App\Models\produk;
use Carbon\Carbon;
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
        // $kodeproduk = 'A01';
        $produk = produk::select('namaproduk','harga')->where('kodeproduk', $kodeproduk)->first();
        // dd($produk);
        if($produk){
            $namaproduk = $produk->namaproduk;
            $hargaproduk = $produk->harga;
        } else {
            $namaproduk = "";
            $hargaproduk = "";
        }

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
        $jumlahperproduk = $kuantitas * $harga - (($diskon/100) * ($kuantitas*$harga));
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
        $total = $request->input('totalInput');   
        $penerima = $request->input('penerima');
    
        $fakturNonota = faktur::where('nonota', $nonota)->first();
    
        if (!$fakturNonota) {
            return response()->json(['success' => false, 'message' => 'Faktur not found']);
        }
    
        $fakturNonota->update([
            'status_diterima' => true,
            'total' => $total,
            'penerima' => $penerima
        ]);

        if ($request->hasFile('buktiInput')) {
            $bukti = $request->file('buktiInput');
            $filename = time() . '.' . $bukti->getClientOriginalExtension();
            $bukti->storeAs('public/test', $filename);
            $fakturNonota->file = $filename;
            $fakturNonota->save();
        }
        // dd($nonota,$total,$bukti);
    
        return redirect('/penjualan-dash');

    }


    public function getPenjualanperBulan(){
        // $penjualan = Penjualan::join('faktur', 'penjualans.nonota', '=', 'faktur.nonota')
        // ->selectRaw('MONTH(faktur.tglfaktur) as bulan, SUM(penjualans.total) as total')
        // ->groupBy('bulan')
        // ->get();
        // $penjualan = Penjualan::with('faktur')->get();
        // $penjualan = Penjualan::join('fakturs', 'penjualans.nonota', '=', 'fakturs.nonota')
        // ->selectRaw("CASE
        //                 WHEN MONTH(fakturs.tglfaktur) = 1 Then 'Januari'
        //                 WHEN MONTH(fakturs.tglfaktur) = 2 Then 'Februari'
        //                 WHEN MONTH(fakturs.tglfaktur) = 3 Then 'Maret'
        //                 WHEN MONTH(fakturs.tglfaktur) = 4 Then 'April'
        //                 WHEN MONTH(fakturs.tglfaktur) = 5 Then 'Mei'
        //                 WHEN MONTH(fakturs.tglfaktur) = 6 Then 'Juni'
        //                 WHEN MONTH(fakturs.tglfaktur) = 7 Then 'Juli'
        //                 WHEN MONTH(fakturs.tglfaktur) = 8 Then 'Agustus'
        //                 WHEN MONTH(fakturs.tglfaktur) = 9 Then 'September'
        //                 WHEN MONTH(fakturs.tglfaktur) = 10 Then 'Oktober'
        //                 WHEN MONTH(fakturs.tglfaktur) = 11 Then 'November'
        //                 WHEN MONTH(fakturs.tglfaktur) = 12 Then 'Desember'
        //             END as bulan, SUM(fakturs.total) as total_penjualan")
        // ->groupBy('bulan')
        // ->get()->toArray();

        $penjualan = faktur::selectRaw("MONTH(tglfaktur)  as bulan, SUM(total) as total_penjualan")
        ->groupBy('bulan')
        ->get()->toArray();
        $namaBulan  = [];
        $total = [];
        foreach($penjualan as $data){
            // $angkaBulan = Carbon::parse($data['bulan'])->month;
            $bulan = Carbon::create()->month($data['bulan'])->format('M');
            $namaBulan[] = $bulan;
            $total[] = $data['total_penjualan'];
        }
    
        // dd($penjualan,$namaBulan,$total);
        return view('dashboard.dash.dashboard', [
            'namaBulan' => $namaBulan,
            'total' => $total
        ]);
    }

}

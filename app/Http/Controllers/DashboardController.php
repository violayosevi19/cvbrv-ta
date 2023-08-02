<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\Stock;
use App\Models\penjualan;
Use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        // cek stock
        $stock = Stock::pluck('stock','namaproduk');
        $stockMin = Stock::pluck('stock_minimum','namaproduk');
        // $productNames = $stock->keys();
        // dd($stockMin);
        $message = [];
        foreach($stock as $namaproduk => $stock){
            // dd($namaproduk);
            $cekStock = $stockMin[$namaproduk];
            // dd($cekStock);
            if ($stock <= $cekStock) {
                // Memicu peringatan atau melakukan tindakan sesuai kebutuhan
                $message[] = "Peringatan: Stok produk $namaproduk abis tu a!";
            } 
        }
        // return view('dashboard.dash.dashboard',[
        //     'produkstock' => $stock,
        //     'produkName' => $productNames,
        //     'stockMin' => $stockMin
        // ]);
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

        // cek penjualan untuk chart
        $penjualan = Penjualan::join('fakturs', 'penjualans.nonota', '=', 'fakturs.nonota')
        ->selectRaw("MONTH(fakturs.tglfaktur)  as bulan, SUM(fakturs.total) as total_penjualan")
        ->groupBy('bulan')
        ->get()->toArray();
        $namaBulan  = [];
        $total = [];
        foreach($penjualan as $data){
            $bulan = Carbon::create()->month($data['bulan'])->format('M');
            $namaBulan[] = $bulan;
            $total[] = $data['total_penjualan'];
        }

        // cek penjualan
        $pendapatan = penjualan::select(\DB::raw("SUM(totalpenjualan) as total"))->get()->toArray()[0]['total'];
        if(!$pendapatan){
            $hasilPenjualan = 0;
        } else {
            $hasilPenjualan = $pendapatan;
        }
        // dd($pendapatan);

        return view('dashboard.dash.dashboard',[
            'stockAlerts' => $message,
            'namaBulan' => $namaBulan,
            'total' => $total,
            'pendapatan' => $hasilPenjualan
        ]);
    }


}

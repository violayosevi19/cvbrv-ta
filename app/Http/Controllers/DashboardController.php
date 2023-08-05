<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\Stock;
use App\Models\penjualan;
use App\Models\faktur;
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
            $persentase = 0;
        } else {
            $hasilPenjualan = $pendapatan;
            $persentase = $pendapatan/30000000 * 100;
        }

        //cek all stock
        $stock = Stock::select(\DB::raw("SUM(stock) as jumlahStock"))->get()->toArray()[0]['jumlahStock'];
        if(!$stock){
            $hasilStock = 0;
        } else {
            $hasilStock = $stock;
        }
         //cek orderan belum selesai
         $belumSelesai = faktur::select(\DB::raw("COUNT(status_diterima) as orderanSelesai"))->where('status_diterima',0)->get()->toArray()[0]['orderanSelesai'];


         // cek data toko yang pernah order
         $tokoUnique = [];
         $cekToko = faktur::selectRaw("COUNT(DISTINCT namatoko) as jmlToko")->get()->toArray()[0]['jmlToko'];
       
        //  dd($cekToko,$tokoUnique);
        return view('dashboard.dash.dashboard',[
            'stockAlerts' => $message,
            'namaBulan' => $namaBulan,
            'total' => $total,
            'pendapatan' => $hasilPenjualan,
            'persentase' => $persentase,
            'stock' => $hasilStock,
            'jml' => $belumSelesai,
            'jmlToko' => $cekToko
        ]);
    }


}

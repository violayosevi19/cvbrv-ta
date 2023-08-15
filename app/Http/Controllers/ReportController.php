<?php

namespace App\Http\Controllers;

use App\Models\LabaRugi;
use App\Models\supplier;
use App\Models\toko;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\penjualan;
use App\Models\Stock;
use App\Models\faktur;
use App\Models\produk;
use PDF;
use Illuminate\Support\Facades\View; 

class ReportController extends Controller
{
    public function index(){
        return view('dashboard.report.daftarlaporan',[
            
        ]);
    }

    public function laporanPenjualan(){
        $penjualan = faktur::where('status_diterima',1)->get()->toArray();
        // dd($penjualan);
        // dd($penjualan);
        $pdf = new Dompdf();
        $fileView = view('dashboard.report.penjualanreport',[
            'penjualans' => $penjualan,
        ])->render();
        $pdf->loadHtml($fileView);
        $pdf->setPaper('A4', 'portrait');
        // Render PDF
        $pdf->render();
        // $pdf = PDF::loadView('dashboard.report.penjualanreport',[
        //        'penjualans' => $penjualan,
        // ]);
        // Kode untuk menghasilkan tampilan PDF untuk diunduh
        return $pdf->stream('Laporan Penjualan.pdf');
       
        // // dd($penjualan);
        // return view('dashboard.report.penjualanreport',[
        //     'penjualans' => $penjualan,
        // ]);
    }

    // public function labaRugi(){
        
    //     // penjualan per bulan
    //     // $totalPenjualanJanuari = faktur::whereRaw("MONTH(diterimapada) = 01")
    //     // ->selectRaw("SUM(total) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $totalPenjualanFebruari = faktur::whereRaw("MONTH(diterimapada) = 02")
    //     // ->selectRaw("SUM(total) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $totalPenjualanMaret = faktur::whereRaw("MONTH(diterimapada) = 03")
    //     // ->selectRaw("SUM(total) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $totalPenjualanApril = faktur::whereRaw("MONTH(diterimapada) = 04")
    //     // ->selectRaw("SUM(total) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $totalPenjualanMei = faktur::whereRaw("MONTH(diterimapada) = 05")
    //     // ->selectRaw("SUM(total) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $totalPenjualanJuni = faktur::whereRaw("MONTH(diterimapada) = 06")
    //     // ->selectRaw("SUM(total) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $totalPenjualanJuli = faktur::whereRaw("MONTH(diterimapada) = 07")
    //     // ->selectRaw("SUM(total) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $totalPenjualanAgustus = faktur::whereRaw("MONTH(diterimapada) = 08")
    //     // ->selectRaw("SUM(total) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $totalPenjualan = faktur::selectRaw("SUM(total) as totalpenjualan")->get()->toArray()[0]['totalpenjualan'];

    //     // pengeluaran per bulan

    //     $labarugi = LabaRugi::all();
    //     // $totalPengeluaranJanuari = LabaRugi::whereRaw("MONTH(tglmulai) = 01")
    //     // ->selectRaw("SUM(biayalistrik+gajikaryawan+biayaoperasional+biayaATK+biayainternet) as totalpenjualan")
    //     // ->first()->totalpenjualan;
    //     // $labakotorJanuari = $totalPenjualanJanuari-$totalPengeluaranJanuari;
    //     // $pajak
    //     // dd($totalPengeluaranJanuari);
    //     // dd($penjualan);
    //     // $pdf = new Dompdf();
    //     // $fileView = view('dashboard.report.labarugi',[
    //     //     // 'penjualans' => $penjualan,
    //     //     'labarugi' => $labarugi,
    //     //     'totalPenjualan' => $totalPenjualan
    //     // ])->render();
    //     // $pdf->loadHtml($fileView);
    //     // $pdf->setPaper('A4', 'portrait');
    //     // // Render PDF
    //     // $pdf->render();
    //     // // Kode untuk menghasilkan tampilan PDF untuk diunduh
    //     // return $pdf->stream('Laporan Laba Rugi.pdf');
       
    
    //     return view('dashboard.report.labarugi',[
    //         'labarugi' => $labarugi,
    //         'totalPenjualan' => $totalPenjualan,
    //         'totalPenjualanJanuari' => $totalPenjualanJanuari,
    //         'totalPenjualanFebruari' => $totalPenjualanFebruari,
    //         'totalPenjualanMaret' => $totalPenjualanMaret,
    //         'totalPenjualanApril' => $totalPenjualanApril,
    //         'totalPenjualanMei' => $totalPenjualanMei,
    //         'totalPenjualanJuni' => $totalPenjualanJuni,
    //         'totalPenjualanJuli' => $totalPenjualanJuli,
    //         'totalPenjualanAgustus' => $totalPenjualanAgustus
    //     ]);
    // }

    public function labaRugi(){
        
        $labarugi = LabaRugi::all();
        // $totalPengeluaranJanuari = LabaRugi::whereRaw("MONTH(tglmulai) = 01")
        // ->selectRaw("SUM(biayalistrik+gajikaryawan+biayaoperasional+biayaATK+biayainternet) as totalpenjualan")
        // ->first()->totalpenjualan;
        // $labakotorJanuari = $totalPenjualanJanuari-$totalPengeluaranJanuari;
        // $pajak
        // dd($totalPengeluaranJanuari);
        // dd($penjualan);
        // $pdf = new Dompdf();
        // $fileView = view('dashboard.report.labarugi',[
        //     // 'penjualans' => $penjualan,
        //     'labarugi' => $labarugi,
        //     'totalPenjualan' => $totalPenjualan
        // ])->render();
        // $pdf->loadHtml($fileView);
        // $pdf->setPaper('A4', 'portrait');
        // // Render PDF
        // $pdf->render();
        // // Kode untuk menghasilkan tampilan PDF untuk diunduh
        // return $pdf->stream('Laporan Laba Rugi.pdf');
       
    
        return view('dashboard.report.labarugi',[
            'labarugi' => $labarugi,
            'totalPenjualan' => 0,
           
        ]);
    }


    public function cetakStok(){
        return view('dashboard.report.cetakstok', ['stock' => Stock::all()]);
    }

    public function cetakProduk(){
        return view('dashboard.report.cetakproduk', ['produks' => produk::all()]);
    }

    public function cetakToko(){
        $tokos = Toko::select('id_toko','namatoko', 'alamat', 'notelp', 'email')
        ->whereIn('id_toko', function ($query) {
            $query->selectRaw('MIN(id_toko)')
                ->from('tokos')
                ->groupBy('namatoko')
                ->havingRaw('COUNT(*) > 1');
        })
        ->get();
        // dd($tokos);
        return view('dashboard.report.cetaktoko', ['tokos' =>$tokos]);
    }

    public function cetakSupplier(){
        $supplier = Supplier::whereIn('kodesupplier', function ($query) {
            $query->selectRaw('MIN(kodesupplier)')
                ->from('suppliers')
                ->groupBy('namasupplier')
                ->havingRaw('COUNT(*) >= 1');
        })
        ->get();        
        // dd($supplier);
        return view('dashboard.report.cetaksupplier', ['suppliers' => $supplier]);
    }

    public function informasiLabaRugi(){
        return view('dashboard.report.indexlabarugi',['produks' => produk::all()]);
    }

    public function cetak(LabaRugi $labaRugi, $id)
    {
        $find = LabaRugi::where('id',$id)->first();
        $bulan = date('m', strtotime($find->tglakhir));
        $totalPenjualan = faktur::whereRaw("MONTH(diterimapada) = ?", [$bulan])
        ->selectRaw("SUM(total) as totalpenjualan")
        ->first()->totalpenjualan;
        // dd($totalPenjualan);
        if($bulan === '01'){
            $namaBulan = "Januari";
        } else if($bulan === '02'){
            $namaBulan = "Februari";
        } else if($bulan === '03'){
            $namaBulan = "Maret";
        } else if($bulan === '04'){
            $namaBulan = "April";
        } else if($bulan === '05'){
            $namaBulan = "Mei";
        } else if($bulan === '06'){
            $namaBulan = "Juni";
        } else if($bulan === '07'){
            $namaBulan = "Juli";
        } else if($bulan === '08'){
            $namaBulan = "Agustus";
        } else if($bulan === '09'){
            $namaBulan = "September";
        } else if($bulan === '10'){
            $namaBulan = "Oktober";
        } else if($bulan === '11'){
            $namaBulan = "November";
        } else {
            $namaBulan = "Desember";
        }
        // dd($namaBulan);
        return view('dashboard.report.labarugibulan',[
            'labarugi' => $find,
            'totalPenjualan' => $totalPenjualan,
            'namaBulan' => $namaBulan
        ]);
    }

// // Fungsi untuk mendapatkan nama bulan berdasarkan nomor bulan
//     private function getNamaBulan($bulan)
//     {
//         $bulanArray = [
//             '01' => 'Januari',
//             '02' => 'Februari',
//             '03' => 'Maret',
//             '04' => 'April',
//             '05' => 'Mei',
//             '06' => 'Juni',
//             '07' => 'Juli',
//             '08' => 'Agustus',
//             '09' => 'September',
//             '10' => 'Oktober',
//             '11' => 'November',
//             '12' => 'Desember'
//         ];

//         return $bulanArray[$month];
//     }

   
}

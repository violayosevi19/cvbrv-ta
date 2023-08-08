<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\penjualan;
use App\Models\Stock;
use App\Models\faktur;
use App\Models\produk;

class ReportController extends Controller
{
    public function index(){
        return view('dashboard.report.daftarlaporan',[
            
        ]);
    }

    public function laporanPenjualan(){
        $penjualan = Penjualan::with('faktur')->get()->toArray();
        // dd($penjualan);
        // $pdf = new Dompdf();
        // $fileView = view('dashboard.report.penjualanreport',[
        //     'penjualans' => $penjualan,
        // ])->render();
        // $pdf->loadHtml($fileView);
        // $pdf->setPaper('A4', 'portrait');
        // // Render PDF
        // $pdf->render();
        // // Kode untuk menghasilkan tampilan PDF untuk diunduh
        // return $pdf->stream('Laporan Penjualan.pdf');
       
        // // dd($penjualan);
        return view('dashboard.report.penjualanreport',[
            'penjualans' => $penjualan,
        ]);
    }

    public function labaRugi(){
        
        // $penjualan = Penjualan::with('faktur')->get()->toArray();
        // dd($penjualan);
        // $pdf = new Dompdf();
        // $fileView = view('dashboard.report.penjualanreport',[
        //     'penjualans' => $penjualan,
        // ])->render();
        // $pdf->loadHtml($fileView);
        // $pdf->setPaper('A4', 'portrait');
        // // Render PDF
        // $pdf->render();
        // // Kode untuk menghasilkan tampilan PDF untuk diunduh
        // return $pdf->stream('Laporan Penjualan.pdf');
       
        // // dd($penjualan);
        return view('dashboard.report.labarugi');
    }

    public function cetakStok(){
        return view('dashboard.report.cetakstok', ['stock' => Stock::all()]);
    }

    public function cetakProduk(){
        return view('dashboard.report.cetakproduk', ['produks' => produk::all()]);
    }

    public function informasiLabaRugi(){
        return view('dashboard.report.indexlabarugi',['produks' => produk::all()]);
    }
}

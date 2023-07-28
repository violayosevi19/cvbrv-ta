<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\penjualan;
use App\Models\faktur;

class ReportController extends Controller
{
    public function index(){
        
        $penjualan = Penjualan::with('faktur')->get()->toArray();
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

use App\Models\detailpesanan;

class CetakPaperController extends Controller
{
    public function index($nonota) {
        $detailProduks = Detailpesanan::select(
            'kodeproduk',
            'namaproduk',
            'kuantitas',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->toArray();
        $detailToko = Detailpesanan::select('namatoko','alamat','tglfaktur','nonota','jatuhtempo','namasales')->distinct()->get()->toArray();
        $totalProdukPerNonota =  Detailpesanan::select(
            'kodeproduk',
            'namaproduk',
            'kuantitas',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->count();;
        // dd($detailProduks,$detailToko[0]['namatoko'],$totalProdukPerNonota);
        $totalFaktur = detailpesanan::where('nonota',$nonota)->sum(\DB::raw('jumlah-diskon'));
        $pdf = new Dompdf();
        $html = view('dashboard.faktur.invoice',[
            'detailtokos' => $detailToko,
            'detailproduks' => $detailProduks,
            'totaldatapernota' => $totalProdukPerNonota,
            'bayar' => $totalFaktur 
        ])->render();
        $pdf->loadHtml($html);

        // Atur opsi (opsional)
        $pdf->setPaper('A4', 'portrait');

        // Render PDF
        $pdf->render();

        // Kode untuk menghasilkan tampilan PDF untuk diunduh
        return $pdf->stream('invoice.pdf');
        // return view('dashboard.faktur.invoice',[
        //     'detailtokos' => $detailToko,
        //     'detailproduks' => $detailProduks,
        //     'totaldatapernota' => $totalProdukPerNonota,
        //     'bayar' => $totalFaktur 
        // ]);
      
        
    }
}

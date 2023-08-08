<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detailpesanan;
use App\Models\stock;
use Illuminate\Validation\Rule;

class ReturnBarangController extends Controller
{
    public function index(){
        return view('dashboard.detailorderan.return');
    }

    public function edit(detailpesanan $detailpesanan,$nonota)
    {
        $detailProduks = Detailpesanan::select(
            'kodeproduk',
            'namaproduk',
            'kuantitas',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->toArray();
        $detailToko = Detailpesanan::select('namatoko','alamat','tglfaktur','nonota','jatuhtempo','namasales')->distinct()->where('nonota',$nonota)->get()->toArray();
        $totalProdukPerNonota =  Detailpesanan::select(
            'kodeproduk',
            'namaproduk',
            'kuantitas',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->count();;
        // dd($detailProduks);
        return view('dashboard.detailorderan.return',[
            'detailtokos' => $detailToko,
            'detailproduks' => $detailProduks,
            'totaldatapernota' => $totalProdukPerNonota
        ]);
    }

    public function update(Request $request, detailpesanan $detailpesanan,$nonota)
    {
        $request->validate([
            'nonota' => 'required',
            'namatoko' => 'required',
            'alamat' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'namasales' => 'required',
            'inputs.*.kodeproduk' => [
                'required',
                Rule::exists('stocks', 'kodeproduk')->where(function ($query) use ($request) {
                    $query->where('stock', '>=', $request->input('inputs.*.kuantitas', 0));
                }),
            ],
            'inputs.*.namaproduk' => 'required',
            'inputs.*.kuantitas' =>  'required',
            'inputs.*.satuan' => 'required',
            'inputs.*.harga' => 'required',
            'inputs.*.diskon' => 'required',
            'inputs.*.jumlah' => 'required',
            
         ], [
            'inputs.*.kuantitas.required' => 'Kode produk harus diisi.',
            'inputs.*.kuantitas.exists' => 'Kode produk tidak valid atau stok produk tidak mencukupi.',
        ]);

         $nonota = $request->input('nonota');
         $namatoko = $request->input('namatoko');
         $alamat = $request->input('alamat');
         $tglfaktur = $request->input('tglfaktur');
         $jatuhtempo = $request->input('jatuhtempo');
         $namasales = $request->input('namasales');

        // Update data nonota dan informasi toko
        $detailpesanan->where('nonota', $nonota)->update([
            'nonota' => $nonota,
            'namatoko' => $namatoko,
            'alamat' => $alamat,
            'tglfaktur' => $tglfaktur,
            'jatuhtempo' => $jatuhtempo,
            'namasales' => $namasales,
        ]);

        //pengurangan atau penambahan selisih kuantitas lama dan baru

        $kuantitasLama = [];
        foreach($request->input('inputs') as $input) {
            $kodeproduk = $input['kodeproduk'];
            $existingProduk = detailpesanan::where('nonota', $nonota)
            ->where('kodeproduk', $kodeproduk)
            ->first();

            if($existingProduk){
                $kuantitasLama[$nonota][$kodeproduk] = $existingProduk->kuantitas;
            }
        }

        foreach ($request->input('inputs') as $input) {
            $input['nonota'] = $nonota;
            $input['namatoko'] = $namatoko;
            $input['alamat'] = $alamat;
            $input['tglfaktur'] = $tglfaktur;
            $input['jatuhtempo'] = $jatuhtempo;
            $input['namasales'] = $namasales;

            //ambil input jikalau ada menambahkan/update field
            $takeKodeProduk = $input['kodeproduk'];
            $takeKuantitas = $input['kuantitas'];

            //aksi jika menambahkan field baru yang produknya belum ada
            $stockData = Stock::where('kodeproduk', $takeKodeProduk)->first();
            $existingProduct = Detailpesanan::where('nonota', $nonota)
            ->where('kodeproduk', $takeKodeProduk)
            ->first();

            if ($existingProduct) {
                if ($stockData) {
                    if ($takeKuantitas < $kuantitasLama[$nonota][$takeKodeProduk]) {
                        $selisihKuantitas = $kuantitasLama[$nonota][$takeKodeProduk] - $takeKuantitas;
                        $stockData->stock += $selisihKuantitas;
                        $stockData->keterangan = 'Stok telah dikembalikan lagi karena return pesanan pada ' . $tglfaktur . ' sebanyak ' . $selisihKuantitas. 'pcs';
                        $stockData->save();
                    } else {
                        $tambahkanKuantitas =  $takeKuantitas - $kuantitasLama[$nonota][$takeKodeProduk] ;
                        $stockData->stock += $tambahkanKuantitas;
                        $stockData->keterangan = 'Stok telah diambil lagi karena perubahan pesanan pada ' . $tglfaktur . ' sebanyak ' . $takeKuantitas . 'pcs';
                        $stockData->save();
                    }
                    $existingProduct->update($input);
                }
            } else {
                // Tambahkan data produk baru
                Detailpesanan::create($input);
                if ($stockData) {
                    if ($stockData->stock >= $takeKuantitas) {
                        $stockData->stock -= $takeKuantitas;
                        $stockData->keterangan = 'Data telah dikurangkan pada pemesanan tanggal ' . $tglfaktur . ' sebanyak ' . $takeKuantitas;
                        $stockData->save();
                    }
                } 
            }
           

        }

        return redirect('/detailorderan-dash')->with('pesan','Update form return barang berhasil');
    }

}

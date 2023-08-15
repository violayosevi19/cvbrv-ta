<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\detailpesanan;
use App\Models\faktur;
use App\Models\produk;
use App\Models\stock;
use App\Models\toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailpesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $detailProduks = Detailpesanan::select('kodeproduk','namaproduk','kuantitas','satuan','harga','diskon','jumlah')->distinct()->get()->toArray();
        $detailToko = Detailpesanan::select('namatoko','alamat','tglfaktur','nonota','jatuhtempo','namasales')->distinct()->get();
        // dd($detailProduks,$detail);
        return view('dashboard.detailorderan.index',[
            'detailtokos' => $detailToko,
            'detailproduks' => $detailProduks,
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentDate = Carbon::now();
        $year = $currentDate->format('y');
        $day = $currentDate->format('d');
        $lastInvoice = detailpesanan::orderBy('id', 'desc')->first();
        $lastNumber = $lastInvoice ? intval(substr($lastInvoice->nonota, 5)) : 0;
        $invoiceNumber = 'C' . $day . $year . str_pad(($lastNumber + 1), 2, '0', STR_PAD_LEFT);
        // dd($currentDate,$year,$day,$lastInvoice,$lastNumber,$invoiceNumber);
        $produks = produk::join('stocks','stocks.kodeproduk','=','produks.kodeproduk')
        ->where('stocks.stock','!=',0)
        ->get();
        // dd($produks);
        $tokos = Toko::select('id_toko','namatoko', 'alamat', 'notelp', 'email')
        ->whereIn('id_toko', function ($query) {
            $query->selectRaw('MIN(id_toko)')
                ->from('tokos')
                ->groupBy('namatoko')
                ->havingRaw('COUNT(*) > 1');
        })
        ->get();
        return view('dashboard.detailorderan.createorderan',[
            'details' => Detailpesanan::all(),
            'nonota' => $invoiceNumber,
            'produks' => $produks,
            'tokos' => $tokos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validateData=$request->validate([
    //         'nonota' => 'required',
    //         'namaproduk' => 'required',
    //         'jumlah' => 'required',
    //         'harga' => 'required',
    //         'tglpesan' => 'required',
    //         // 'kodeproduk' => 'required|unique:detailpesanans'
    //      ]);

    //     Detailpesanan::create($validateData);
    //     return redirect('/detailorderan-dash')->with('pesan','Data berhasil ditambah');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'nonota' => 'required',
            'namatoko' => 'required',
            'alamat' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'namasales' => 'required',
            // 'inputs.*.kodeproduk' => [
            //     'required',
            //     Rule::exists('stocks', 'kodeproduk')->where(function ($query) use ($request) {
            //         $query->where('stock', '>=', $request->input('inputs.*.kuantitas', 0));
            //     }),
            // ],
            'inputs.*.kodeproduk' => 'required',
            'inputs.*.namaproduk' => 'required',
            'inputs.*.kuantitas' => 'required',
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
        //  $kuantitas =  $request->input('inputs.*.kuantitas');

         foreach ($request->input('inputs') as $input) {
            $input['nonota'] = $nonota;
            $input['namatoko'] = $namatoko;
            $input['alamat'] = $alamat;
            $input['tglfaktur'] = $tglfaktur;
            $input['jatuhtempo'] = $jatuhtempo;
            $input['namasales'] = $namasales;
            $input['jumlah'] = (int) preg_replace('/\D/', '', $input['jumlah']); // Menghapus semua karakter non-digit

            $takeKodeProduk = $input['kodeproduk'];
            $takeKuantitas = $input['kuantitas'];
        

            $stockData = Stock::where('kodeproduk', $takeKodeProduk)->first();
            // dd($takeKuantitas,$stockData->stock);
            if ($stockData) {
                if ($stockData->stock >= $takeKuantitas) {
                    $stockData->stock -= $takeKuantitas;
                    $stockData->keterangan = 'Data telah dikurangkan pada pemesanan tanggal ' .date('d-m-Y',strtotime($tglfaktur)) . ' sebanyak ' . $takeKuantitas;
                    $stockData->save();
                } else {
                    return redirect('/detailorderan-dash')->with('error','Stock Tidak cukup!');
                }
            } 
            Detailpesanan::create($input);

        }

        return redirect('/detailorderan-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detailpesanan  $detailpesanan
     * @return \Illuminate\Http\Response
     */
    // public function show(detailpesanan $detailpesanan,$nonota)
    // {
    //     $takeNota = detailpesanan::where('nonota','=',$nonota)->get()->all();
    //     $namaToko = faktur::where('nonota','=', $nonota)->get()->toArray();
    //     $total = detailpesanan::where('nonota','=',$nonota)->sum(\DB::raw('jumlah*harga'));
    //     // dd($takeNota,$total);
    //     // $takeData = detailpesanan::find($id);
    //     // dd($takeData);
    //     // dd($takeNota);
        
    //     if(!$takeNota){
    //         $errorMessage = 'Terjadi kesalahan dalam memproses data.';
    //         session()->flash('error', $errorMessage);
    //         return redirect('/detailpesanan-dash');
    //     } else {
    //         return view('dashboard.detailorderan.read',[
    //             'takeNotas' => $takeNota,
    //             'total' => $total,
    //             'namaToko' => $namaToko[0]['namatoko']
    //         ]);
    //     }
        
    // }

    public function show(detailpesanan $detailpesanan,$nonota)
    {
        $detailProduks = Detailpesanan::select(
            'kodeproduk',
            'namaproduk',
            'kuantitas',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->orderBy('kodeproduk','asc')->get()->toArray();
        $detailToko = Detailpesanan::select('namatoko','alamat','tglfaktur','nonota','jatuhtempo','namasales')->distinct()->where('nonota', $nonota)->get()->toArray();
        // dd($detailToko);
        $totalProdukPerNonota =  Detailpesanan::select(
            'kodeproduk',
            'namaproduk',
            'kuantitas',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->count();;
        // dd($detailProduks[0]['harga']);
        $totalFaktur = detailpesanan::where('nonota',$nonota)->sum(\DB::raw('jumlah-diskon'));
        // dd($totalFaktur);
        return view('dashboard.detailorderan.readorderan',[
            'detailtokos' => $detailToko,
            'detailproduks' => $detailProduks,
            'totaldatapernota' => $totalProdukPerNonota,
            'bayar' => $totalFaktur 
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detailpesanan  $detailpesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(detailpesanan $detailpesanan,$nonota)
    {
        // $detailProduks = Detailpesanan::select(
        //     'kodeproduk',
        //     'namaproduk',
        //     'kuantitas',
        //     'satuan',
        //     'harga',
        //     'diskon',
        //     'jumlah')
        //     ->where('nonota','=',$nonota)->get()->toArray();
         
        // $detailToko = Detailpesanan::select('namatoko','alamat', DB::raw('DATE_FORMAT(tglfaktur, "%d-%m-%Y") as tglfaktur'),'nonota','jatuhtempo','namasales')->distinct()->where('nonota',$nonota)->get()->toArray();
        // dd($detailToko);
        $detailToko = Detailpesanan::where('nonota',$nonota)->get()->toArray();
        // dd($detailToko);
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
        return view('dashboard.detailorderan.editorderan',[
            // 'detailtokos' => $detailToko,
            // 'detailproduks' => $detailProduks,
            'detailtokos' => $detailToko,
            'totaldatapernota' => $totalProdukPerNonota,
            'produks' => produk::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\detailpesanan  $detailpesanan
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, detailpesanan $detailpesanan,$id)
    // {
        
    //     $validateData=$request->validate([
    //         'nonota' => 'required',
    //         'namaproduk' => 'required',
    //         'jumlah' => 'required',
    //         'harga' => 'required',
    //         'tglpesan' => 'required',
    //     ]);

    //     Detailpesanan::where('id',$id)->update($validateData);
    //     return redirect('/detailorderan-dash')->with('pesan','Data berhasil diupdate');
    // }

    public function update(Request $request, detailpesanan $detailpesanan,$nonota)
    {
        $request->validate([
            'nonota' => 'required',
            'namatoko' => 'required',
            'alamat' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'namasales' => 'required',
            // 'inputs.*.kodeproduk' => [
            //     'required',
            //     Rule::exists('stocks', 'kodeproduk')->where(function ($query) use ($request) {
            //         $query->where('stock', '>=', $request->input('inputs.*.kuantitas', 0));
            //     }),
            // ],
            'inputs.*.kodeproduk' => 'required',
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
        // dd($kuantitasLama);

        foreach ($request->input('inputs') as $input) {
            $input['nonota'] = $nonota;
            $input['namatoko'] = $namatoko;
            $input['alamat'] = $alamat;
            $input['tglfaktur'] = $tglfaktur;
            $input['jatuhtempo'] = $jatuhtempo;
            $input['namasales'] = $namasales;
            $input['jumlah'] = (int) preg_replace('/\D/', '', $input['jumlah']); // Menghapus semua karakter non-digit

            //ambil input jikalau ada menambahkan/update field
            $takeKodeProduk = $input['kodeproduk'];
            $takeKuantitas = $input['kuantitas'];

            //aksi jika menambahkan field baru yang produknya belum ada
            $stockData = Stock::where('kodeproduk', $takeKodeProduk)->first();
            $existingProduct = Detailpesanan::where('nonota', $nonota)
            ->where('kodeproduk', $takeKodeProduk)
            ->first();
            // $selisih = $takeKuantitas - $kuantitasLama[$nonota][$takeKodeProduk];
            // dd($stockData->stock, $takeKuantitas,$selisih);


            if ($existingProduct) {
                if ($stockData) {
                        if ($takeKuantitas < $kuantitasLama[$nonota][$takeKodeProduk]) {
                            $selisihKuantitas = $kuantitasLama[$nonota][$takeKodeProduk] - $takeKuantitas;
                            $stockData->stock += $selisihKuantitas;
                            // dd($takeKuantitas, $kuantitasLama[$nonota][$takeKodeProduk], $selisihKuantitas);
                            $stockData->keterangan = 'Stok telah dikembalikan lagi karena perubahan pesanan pada ' . date('d-m-Y',strtotime($tglfaktur)) . ' sebanyak ' . $takeKuantitas;
                            $stockData->save();
                        } else {
                            $tambahkanKuantitas =  $takeKuantitas - $kuantitasLama[$nonota][$takeKodeProduk] ;
                            if($stockData->stock > $tambahkanKuantitas){
                                $stockData->stock -= $tambahkanKuantitas;
                                $stockData->keterangan = 'Stok telah diambil lagi karena perubahan pesanan pada ' . date('d-m-Y',strtotime($tglfaktur)) . ' sebanyak ' . $takeKuantitas;
                                $stockData->save();
                            } else if($stockData->stock = $tambahkanKuantitas){
                                $stockData->stock -= $tambahkanKuantitas;
                                $stockData->keterangan = 'Stok telah diambil lagi karena perubahan pesanan pada ' . date('d-m-Y',strtotime($tglfaktur)) . ' sebanyak ' . $takeKuantitas;
                                $stockData->save();
                            } else {
                                // dd($stockData->stock, $tambahkanKuantitas);
                                return redirect('/detailorderan-dash')->with('error','Stok tidak cukup!');
                            }
                            // dd($tambahkanKuantitas);
                          
                        }
                        $existingProduct->update($input);
                  
                }
            } else {
                // Tambahkan data produk baru
                Detailpesanan::create($input);
                if ($stockData) {
                    if ($stockData->stock >= $takeKuantitas) {
                        $stockData->stock -= $takeKuantitas;
                        $stockData->keterangan = 'Data telah dikurangkan pada pemesanan tanggal ' . date('d-m-Y',strtotime($tglfaktur)) . ' sebanyak ' . $takeKuantitas;
                        $stockData->save();
                    } else {
                        return redirect('/detailorderan-dash')->with('error','Stok tidak cukup!');
                    }
                } 
            }
           

        }

        return redirect('/detailorderan-dash')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detailpesanan  $detailpesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(detailpesanan $detailpesanan,$nonota)
    {
        Detailpesanan::where('nonota', '=', $nonota)->delete();
         return redirect('/detailorderan-dash');

    }
}

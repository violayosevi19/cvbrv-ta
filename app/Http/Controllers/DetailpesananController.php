<?php

namespace App\Http\Controllers;

use App\Models\detailpesanan;
use App\Models\faktur;
use App\Models\produk;
use App\Models\stock;
use App\Models\toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

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
            'detailproduks' => $detailProduks
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.detailorderan.createorderan',['details' => Detailpesanan::all()]);
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
            'inputs.*.kodeproduk' => [
                'required',
                Rule::exists('stocks', 'kodeproduk')->where(function ($query) use ($request) {
                    $query->where('stock', '>=', $request->input('inputs.*.kuantitas', 0));
                }),
            ],
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

         foreach ($request->input('inputs') as $input) {
            $input['nonota'] = $nonota;
            $input['namatoko'] = $namatoko;
            $input['alamat'] = $alamat;
            $input['tglfaktur'] = $tglfaktur;
            $input['jatuhtempo'] = $jatuhtempo;
            $input['namasales'] = $namasales;

            Detailpesanan::create($input);

            $takeKodeProduk = $input['kodeproduk'];
            $takeKuantitas = $input['kuantitas'];

            $stockData = Stock::where('kodeproduk', $takeKodeProduk)->first();
            if ($stockData) {
                if ($stockData->stock >= $takeKuantitas) {
                    $stockData->stock -= $takeKuantitas;
                    $stockData->keterangan = 'Data telah dikurangkan pada pemesanan tanggal ' . $tglfaktur . ' sebanyak ' . $takeKuantitas;
                    $stockData->save();
                }
            } 

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
        // dd($detailProduks);
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
        // dd($detailProduks);
        return view('dashboard.detailorderan.editorderan',[
            'detailtokos' => $detailToko,
            'detailproduks' => $detailProduks,
            'totaldatapernota' => $totalProdukPerNonota
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
                        $stockData->stock -= $selisihKuantitas;
                        $stockData->keterangan = 'Stok diambil pada perubahan pesanan ' . $tglfaktur . ' sebanyak ' . $takeKuantitas;
                        $stockData->save();
                    } else {
                        $tambahkanKuantitas =  $kuantitasLama[$nonota][$takeKodeProduk] - $takeKuantitas;
                        $stockData->stock += $tambahkanKuantitas;
                        $stockData->keterangan = 'Stok telah ditambahkan pada perubahan pesanan ' . $tglfaktur . ' sebanyak ' . $takeKuantitas;
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
         return redirect('/detailorderan-dash')->with('pesan','Data berhasil dihapus');

    }
}

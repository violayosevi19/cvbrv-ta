<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\produk;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nonota = BarangMasuk::select(DB::raw('MAX(id) as max_id'), 'nonota', 'namasupplier', 'tanggalmasuk')
                     ->groupBy('nonota','namasupplier','tanggalmasuk')
                     ->get();
        // dd($nonota);
        return view('dashboard.pengelolaanbarang.barangmasuk.index',[
            'barangmasuks' => $nonota
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pengelolaanbarang.barangmasuk.createbarang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'kodeproduk' => 'required',
    //         'namaproduk' => 'required',
    //         'kodesupplier' => 'required',
    //         'tanggalmasuk' => 'required',
    //         'jumlahbarangmasuk' => 'required'
    //     ]);
       
    //     $barangMasuk = BarangMasuk::create($validateData);
    //     $cekStock = Stock::where('kodeproduk', $barangMasuk->kodeproduk)->first();

    //     if($cekStock){
    //         $cekStock->stock += $barangMasuk->jumlahbarangmasuk;
    //         $cekStock->keterangan = 'Data telah ditambahkan pada ' .$barangMasuk->created_at. ' sebanyak ' .$barangMasuk->jumlahbarangmasuk;
    //         $cekStock->save();
    //     } else {
    //         $cekStock = new Stock;
    //         $cekStock->kodeproduk = $barangMasuk->kodeproduk;
    //         $cekStock->namaproduk = $barangMasuk->namaproduk;
    //         $cekStock->stock = $barangMasuk->jumlahbarangmasuk;
    //         $cekStock->keterangan = 'Data telah ditambahkan pada ' .$barangMasuk->created_at. ' sebanyak ' .$barangMasuk->jumlahbarangmasuk;
    //         $cekStock->save();

    //     }
        
    //     return redirect('/barangmasuk-dash')->with('pesan','Data berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'namasupplier' => 'required',
            'tanggalmasuk' => 'required',
            'nonota' => 'required',
            'inputs.*.kodeproduk' => 'required',
            'inputs.*.namaproduk' => 'required',
            'inputs.*.stock' => 'required',
            'inputs.*.harga' => 'required',
            'inputs.*.diskon' => 'required',
            'inputs.*.jumlah' => 'required'
        ]);

        $namasupplier = $request->input('namasupplier');
        $tanggalmasuk = $request->input('tanggalmasuk');
        $nonota = $request->input('nonota'); 
        $totalFaktur = 0; 

        foreach ($request->input('inputs') as $value) {
            $value['namasupplier'] = $namasupplier;
            $value['tanggalmasuk'] = $tanggalmasuk;
            $value['nonota'] = $nonota;
            BarangMasuk::create($value);

            $kodeproduk = $value['kodeproduk'];
            $stock = $value['stock'];
            $totalFaktur += $value['jumlah'];

            $stockData = Stock::where('kodeproduk', $kodeproduk)->first();
            $produkData = Produk::where('kodeproduk', $kodeproduk)->first();
        
            if ($stockData) {
                $stockData->stock += $stock;
                $stockData->keterangan = 'Data telah ditambahkan pada ' . $tanggalmasuk . ' sebanyak ' . $stock;
                $stockData->save();
            } else {
                $stockData = new Stock;
                $stockData->kodeproduk = $kodeproduk;
                $stockData->namaproduk = $value['namaproduk'];
                $stockData->stock = $stock;
                $stockData->keterangan = 'Data telah ditambahkan pada ' . $tanggalmasuk . ' sebanyak ' . $stock;
                $stockData->save();
            }

            if (!$produkData) {
                $produkData = new Produk;
                $produkData->kodeproduk = $kodeproduk;
                $produkData->namaproduk = $value['namaproduk'];
                $produkData->save();
            } else {
                echo "data lah ado";
            }
        }

            $supplier = new Supplier();
            $supplier->namasupplier = $namasupplier;
            $supplier->tglfaktur = $tanggalmasuk;
            $supplier->nonota = $nonota;
            $supplier->total = $totalFaktur;
            $supplier->save();
    

       
        return redirect('/barangmasuk-dash')->with('pesan','Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $barangMasuk,$nonota)
    {
        $detailProduks = BarangMasuk::select(
            'kodeproduk',
            'namaproduk',
            'stock',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->toArray();
        $detailToko = BarangMasuk::select('namasupplier','nonota','tanggalmasuk')->distinct()->get()->toArray();
        $totalProdukPerNonota =  BarangMasuk::select(
            'kodeproduk',
            'namaproduk',
            'stock',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->count();;
        // dd($detailProduks);
        $totalFaktur = BarangMasuk::where('nonota',$nonota)->sum(\DB::raw('jumlah'));
        // dd($totalFaktur);
        return view('dashboard.pengelolaanbarang.barangmasuk.readbarang',[
            'detailtokos' => $detailToko,
            'detailproduks' => $detailProduks,
            'totaldatapernota' => $totalProdukPerNonota,
            'bayar' => $totalFaktur 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    // public function edit(BarangMasuk $barangMasuk,$id)
    // {
    //     return view('dashboard.pengelolaanbarang.barangmasuk.editbarang',[
    //         'barangmasuks' => BarangMasuk::find($id)
    //     ]);
    // }

    public function edit(BarangMasuk $barangmasuk,$nonota)
    {
        $detailProduks = BarangMasuk::select(
            'kodeproduk',
            'namaproduk',
            'stock',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->toArray();
        $detailFaktur = BarangMasuk::select('namasupplier','tanggalmasuk','nonota')->distinct()->where('nonota', $nonota)->get()->toArray();
        $totalProdukPerNonota =  BarangMasuk::select(
            'kodeproduk',
            'namaproduk',
            'stock',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->count();;
        // dd($detailProduks);
        return view('dashboard.pengelolaanbarang.barangmasuk.editbarang',[
            'detailfaktur' => $detailFaktur,
            'detailproduks' => $detailProduks,
            'totaldatapernota' => $totalProdukPerNonota
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, BarangMasuk $barangMasuk,$id)
    // {
    //     $validateData = $request->validate([
    //         'kodeproduk' => 'required',
    //         'kodesupplier' => 'required',
    //         'tanggalmasuk' => 'required',
    //         'jumlahbarangmasuk' => 'required'
    //     ]);
        
    //     BarangMasuk::where('id',$id)->update($validateData);
    //     return redirect('/barangmasuk-dash')->with('pesan','Data berhasil ditambahkan');
    // }
    public function update(Request $request, BarangMasuk $barangmasuk,$nonota)
    {
        $request->validate([
            'namasupplier' => 'required',
            'tanggalmasuk' => 'required',
            'nonota' => 'required',
            'inputs.*.kodeproduk' => 'required',
            'inputs.*.namaproduk' => 'required',
            'inputs.*.stock' => 'required',
            'inputs.*.harga' => 'required',
            'inputs.*.diskon' => 'required',
            'inputs.*.jumlah' => 'required'
            
         ]);

         $namasupplier = $request->input('namasupplier');
         $tanggalmasuk = $request->input('tanggalmasuk');
         $nonota = $request->input('nonota');

        // Update data nonota
        $barangmasuk->where('nonota', $nonota)->update([
            'nonota' => $nonota,
            'namasupplier' => $namasupplier,
            'tanggalmasuk' => $tanggalmasuk,
        ]);

         foreach ($request->input('inputs') as $input) {
            $input['nonota'] = $nonota;
            $input['tanggalmasuk'] = $tanggalmasuk;
            $input['namasupplier'] = $namasupplier;

            $editStock = $input['stock'];
            $takeKodeProduk = $input['kodeproduk'];
            $existingProduct = BarangMasuk::where('nonota', $nonota)
                ->where('kodeproduk', $takeKodeProduk)
                ->first();

            if ($existingProduct) {
                // Update data produk yang sudah ada
                if(isset($editStock) && $editStock !== '') {
                   Stock::where('kodeproduk', $takeKodeProduk)
                    ->update([
                        'stock' => $editStock,
                    ]);
                }
                $existingProduct->update($input);
            } else {
                // Tambahkan data produk baru
                BarangMasuk::create($input);
                // Tambahkan data produk baru ke tabel Stock dan Produk jika belum ada
                $productExists = Produk::where('kodeproduk', $takeKodeProduk)->exists();
                if (!$productExists) {
                    Produk::create([
                        'kodeproduk' => $takeKodeProduk,
                        'namaproduk' => $input['namaproduk'],
                    ]);

                    // Tambahkan juga data produk baru ke tabel Stock
                    Stock::create([
                        'kodeproduk' => $takeKodeProduk,
                        'namaproduk' => $input['namaproduk'],
                        'stock' => $input['stock'],
                        'keterangan' => 'Stok baru masuk sebanyak ' . $input['stock'] . ' pada ' . $tanggalmasuk ,
                    ]);
                } 
            }
           

        }

        return redirect('/barangmasuk-dash')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangMasuk $barangMasuk,$id)
    {
        BarangMasuk::destroy($id);
        return redirect('/barangmasuk-dash');
    }
}

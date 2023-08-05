<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\produk;
use App\Models\jenisproduk;
use App\Models\supplier;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.produk.index',['produks' => Produk::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.produk.create',[
            'produks' => Produk::all(),
            'jenisproduks' => Jenisproduk::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $validateData = $request->validate([
            'kodeproduk' => 'required',
            'namaproduk' => 'required',
            'harga' => 'required',
            'jenisproduk_id' => 'required',
        ]);

        Produk::create($validateData);
        return redirect('/produk-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(produk $produk,$kodeproduk)
    {
        $takeBarangMasuk = BarangMasuk::where('kodeproduk','=',$kodeproduk)->first();
        if (!$takeBarangMasuk) {
            return redirect('/produk-dash')->with('error', 'Tidak ada supplier dengan nama tersebut ditemukan');
        }

        $namasupplier = $takeBarangMasuk->namasupplier;
        $takeSupplier = supplier::where('namasupplier', $namasupplier)->first();
        if(!$takeSupplier){
            return redirect('/produk-dash')->with('error','Nama supplier tidak ada');
        }
        $takeDataSupplier = supplier::where('namasupplier', $takeSupplier->namasupplier)->get()->all();
        $produk = supplier::with('barangMasuk')->get()->toArray();
        $dataProduk = [];
        foreach($produk as $data){
           foreach($data['barang_masuk'] as $value){
                $dataProduk[] = [
                    'kodeproduk' => $value['kodeproduk'],
                    'namaproduk' => $value['namaproduk']
                ];
           }
        }
        // Get unique entries based on 'kodeproduk'
        $ambilProdukUnik = array_unique($dataProduk, SORT_REGULAR);
        // If you need to reset the keys of the resulting array
        $result = array_values($ambilProdukUnik);
        // dd($takeBarangMasuk,$takeSupplier->namasupplier,$namasupplier,$takeDataSupplier);
        return view('dashboard.supplier.read',[
            'detailSupplier' => $takeDataSupplier,
            'produks' => $result
        ]);
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(produk $produk,$id)
    {
        return view('dashboard.produk.edit',[
            'produks' => Produk::find($id),
            'jenisproduks' => Jenisproduk::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produk $produk,$id)
    {
        
         $validateData = $request->validate([
            'kodeproduk' => 'required',
            'namaproduk' => 'required',
            'harga' => 'required',
            'jenisproduk_id' => 'required',
        ]);

        Produk::where('id',$id)->update($validateData);
        return redirect('/produk-dash')->with('pesan','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(produk $produk,$id)
    {
        Produk::destroy($id);
        return redirect('/produk-dash');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\jenisproduk;
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
            'satuan' => 'required',
            'harga' => 'required',
            'stock' => 'required',
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
    public function show(produk $produk)
    {
        //
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
            'satuan' => 'required',
            'harga' => 'required',
            'stock' => 'required',
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
        return redirect('/produk-dash')->with('pesan','Data berhasil dihapus');
    }
}

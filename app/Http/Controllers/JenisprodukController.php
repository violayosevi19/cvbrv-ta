<?php

namespace App\Http\Controllers;

use App\Models\jenisproduk;
use Illuminate\Http\Request;

class JenisprodukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.jenisproduk.index',['jenisproduks' => Jenisproduk::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jenisproduk.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'jenis' => 'required'
        ]);

        Jenisproduk::create($validateData);
        return redirect('/jenisproduk-dash')->with('pesan','data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jenisproduk  $jenisproduk
     * @return \Illuminate\Http\Response
     */
    public function show(jenisproduk $jenisproduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jenisproduk  $jenisproduk
     * @return \Illuminate\Http\Response
     */
    public function edit(jenisproduk $jenisproduk,$id)
    {
        return view('dashboard.jenisproduk.edit',['jenisproduks' => Jenisproduk::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jenisproduk  $jenisproduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jenisproduk $jenisproduk,$id)
    {
        $validateData=$request->validate([
            'jenis' => 'required'
        ]);

        Jenisproduk::where('id',$id)->update($validateData);
        return redirect('/jenisproduk-dash')->with('pesan','data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jenisproduk  $jenisproduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(jenisproduk $jenisproduk,$id)
    {
        Jenisproduk::destroy($id);
        return redirect('/jenisproduk-dash')->with('pesan','Data berhasil dihapus');
    }
}

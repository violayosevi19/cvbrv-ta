<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pembayaran.index',['pembayarans' => Pembayaran::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pembayaran.create',['pembayarans' => Pembayaran::all()]);
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
            'nonota' => 'required|unique:pembayarans',
            'namatoko' => 'required',
            'totalpembayaran' => 'required',
            'keterangan' => 'required',
            'tglbayar' => 'required',
        ]);

        Pembayaran::create($validateData);
        return redirect('/pembayaran-dash')->with('pesan','Data berhasil ditambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(pembayaran $pembayaran,$id)
    {
        return view('dashboard.pembayaran.edit',['pembayarans' => Pembayaran::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pembayaran $pembayaran,$id)
    {
        $validateData=$request->validate([
            'nonota' => 'required',
            'namatoko' => 'required',
            'totalpembayaran' => 'required',
            'keterangan' => 'required',
            'tglbayar' => 'required',
        ]);

        Pembayaran::where('id',$id)->update($validateData);
        return redirect('/pembayaran-dash')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembayaran $pembayaran,$id)
    {
        Pembayaran::destroy($id);
          return redirect('/pembayaran-dash')->with('pesan','Data berhasil dihapus');
    }
}

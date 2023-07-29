<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.penjualan.index',['penjualans' => Penjualan::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.penjualan.create',['penjualans' => Penjualan::all()]);
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
            'nonota' => 'required',
            'namatoko' => 'required',
            'totalpenjualan' => 'required'
        ]);

        Penjualan::create($validateData);
        return redirect('/penjualan-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(penjualan $penjualan,$id)
    {
        return view('dashboard.penjualan.edit',['penjualans' => Penjualan::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penjualan $penjualan,$id)
    {
        $validateData=$request->validate([
            'nonota' => 'required',
            'namatoko' => 'required',
            'totalpenjualan' => 'required'
        ]);

        Penjualan::where('id',$id)->update($validateData);
        return redirect('/penjualan-dash')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(penjualan $penjualan,$id)
    {
        Penjualan::destroy($id);
        return redirect('/penjualan-dash');

    }
}

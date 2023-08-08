<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.stock.index',[
            'stocks' => Stock::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.stock.create');
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
            'stock' => 'required',
        ]);

        $stock = $validateData['stock'];
        $satuan = $validateData['satuan'];
        $date = date('d-m-Y', strtotime(now()));
        $keterangan = 'Stock telah ditambahkan pada ' . $date . ' sebanyak ' . $stock . ' ' . $satuan;
        $validateDataNew = array_merge($validateData, ['keterangan' => $keterangan]);

        Stock::create($validateDataNew);
      
        return redirect('/stock-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock,$id)
    {
        return view('dashboard.stock.edit',['stocks' => Stock::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock,$id)
    {
        $validateData = $request->validate([
            'kodeproduk' => 'required',
            'namaproduk' => 'required',
            'satuan' => 'required',
            'stock' => 'required',
            'stock_minimum' => 'required'
        ]);

        $stock = $validateData['stock'];
        $satuan = $validateData['satuan'];
        $date = date('d-m-Y', strtotime(now()));
        $keterangan = 'Stock diubah pada ' . $date . ' sebanyak ' . $stock . ' ' . $satuan;
        $validateDataNew = array_merge($validateData, ['keterangan' => $keterangan]);

        Stock::where('id',$id)->update($validateDataNew);
    
        return redirect('/stock-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock,$id)
    {
        Stock::destroy($id);
        return redirect('/stock-dash');
    }
}

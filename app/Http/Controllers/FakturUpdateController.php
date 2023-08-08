<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakturUpdateController extends Controller
{
    public function create()
    {
        $nonota = request('nonota');
        $detail = detailpesanan::select(
            DB::raw('SUM(jumlah) as total_amount'),
            'namatoko',
            'tglfaktur',
            'jatuhtempo'
        )->where('nonota',$nonota)->groupBy('namatoko', 'tglfaktur', 'jatuhtempo')->get()->toArray();
        // dd($detail);
        // dd($nonota);
        return view('dashboard.faktur.create',[
            'nonota' => $nonota,
            'faktur' => $detail
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
        $validateData=$request->validate([
            'nonota' => 'required|unique:fakturs',
            'namatoko' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'keterangan' => 'required',
            'pembayaran' => 'required',
            'total' => 'required',
            'sopir' => 'required'
        ]);
        
        $nonota = $request->input('nonota');
        $namatoko = $request->input('namatoko');

        $toko = new toko();
        $toko->nonota = $nonota;
        $toko->namatoko = $namatoko;
        $toko->save();

        Faktur::create($validateData);
        return redirect('/faktur-dash')->with('pesan','Data berhasil ditambah');
    }
}

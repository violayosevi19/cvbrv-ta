<?php

namespace App\Http\Controllers;

use App\Models\detailpesanan;
use Illuminate\Http\Request;

class DetailpesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.detailpesanan.index',['details' => Detailpesanan::all()]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.detailpesanan.create',['details' => Detailpesanan::all()]);
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
            'namaproduk' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'tglpesan' => 'required',
            // 'kodeproduk' => 'required|unique:detailpesanans'
         ]);

        Detailpesanan::create($validateData);
        return redirect('/detailpesanan-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detailpesanan  $detailpesanan
     * @return \Illuminate\Http\Response
     */
    public function show(detailpesanan $detailpesanan,$nonota)
    {
        $takeNota = detailpesanan::where('nonota','=',$nonota)->get()->all();
        // dd($takeNota);
        // $takeData = detailpesanan::find($id);
        // dd($takeData);
        // dd($takeNota);
        
        if(!$takeNota){
            $errorMessage = 'Terjadi kesalahan dalam memproses data.';
            session()->flash('error', $errorMessage);
            return redirect('/detailpesanan-dash');
        } else {
            return view('dashboard.detailpesanan.read',['takeNotas' => $takeNota]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detailpesanan  $detailpesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(detailpesanan $detailpesanan,$id)
    {
        return view('dashboard.detailpesanan.edit',[
            'details' => Detailpesanan::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\detailpesanan  $detailpesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, detailpesanan $detailpesanan,$id)
    {
        
        $validateData=$request->validate([
            'nonota' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'tglpesan' => 'required',
            'kodeproduk' => 'required'
        ]);

        Detailpesanan::where('id',$id)->update($validateData);
        return redirect('/detailpesanan-dash')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detailpesanan  $detailpesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(detailpesanan $detailpesanan,$id)
    {
        Detailpesanan::destroy($id);
         return redirect('/detailpesanan-dash')->with('pesan','Data berhasil dihapus');

    }
}

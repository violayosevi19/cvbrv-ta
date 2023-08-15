<?php

namespace App\Http\Controllers;

use App\Models\toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tokos = Toko::select('id_toko','namatoko', 'alamat', 'notelp', 'email')
        ->whereIn('id_toko', function ($query) {
            $query->selectRaw('MIN(id_toko)')
                ->from('tokos')
                ->groupBy('namatoko')
                ->havingRaw('COUNT(*) > 1');
        })
        ->get();
        return view('dashboard.toko.index',['tokos'=> $tokos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.toko.create');
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
            'id_toko' => 'required|unique:tokos',
            'namatoko' => 'required',
            'alamat' => 'required',
            'notelp' => 'required',
            'email' => 'required',
        ]);

        Toko::create($validateData);
        return redirect('/toko-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function show(toko $toko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function edit(toko $toko,$id)
    {
        // dd($id);
        $tokos = Toko::where('id_toko',$id)->get()->toArray()[0];
        // dd($tokos);
        return view('dashboard.toko.edit',[
            'tokos' => $tokos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, toko $toko,$id)
    {
        $validateData=$request->validate([
            'id_toko' => 'required',
            'namatoko' => 'required',
            'alamat' => 'required',
            'notelp' => 'required',
            'email' => 'required',
            'nonota' => 'required'
        ]);

        Toko::where('id',$id)->update($validateData);
        return redirect('/toko-dash')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy(toko $toko,$id)
    {
        Toko::where('id_toko',$id)->delete();
        return redirect('/toko-dash');
    }
}

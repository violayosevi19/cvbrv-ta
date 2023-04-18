<?php

namespace App\Http\Controllers;

use App\Models\faktur;
use Illuminate\Http\Request;

class FakturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.faktur.index',['fakturs' => Faktur::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.faktur.create',['fakturs' => Faktur::all()]);
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
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'namatoko' => 'required',
            'total' => 'required'
        ]);

        Faktur::create($validateData);
        return redirect('/faktur-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faktur  $faktur
     * @return \Illuminate\Http\Response
     */
    public function show(faktur $faktur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faktur  $faktur
     * @return \Illuminate\Http\Response
     */
    public function edit(faktur $faktur,$id)
    {
         return view('dashboard.faktur.edit',['fakturs' => Faktur::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\faktur  $faktur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, faktur $faktur,$id)
    {
        $validateData=$request->validate([
            'nonota' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'namatoko' => 'required',
            'total' => 'required'
        ]);

        Faktur::where('id',$id)->update($validateData);
        return redirect('/faktur-dash')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faktur  $faktur
     * @return \Illuminate\Http\Response
     */
    public function destroy(faktur $faktur,$id)
    {
        Faktur::destroy($id);
        return redirect('/faktur-dash')->with('pesan','Data berhasil dihapus');

    }
}

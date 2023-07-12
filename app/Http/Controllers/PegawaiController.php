<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pegawai.index',['pegawais' => Pegawai::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pegawai.create',['pegawais' => 
        Pegawai::all()

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
            'idpegawai' => 'required|unique:pegawais|size:10',
            'nama' => 'required',
            'tgllahir' => 'required',
            'jekel' => 'required|in:L,P',
            'alamat' => 'required',
            'tamatan' => 'required',
            'jabatan' => 'required'
        ]);

        Pegawai::create($validateData);
        return redirect('/pegawai-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(pegawai $pegawai, $id)
    {
        return view('dashboard.pegawai.edit', [
            'pegawais' => Pegawai::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pegawai $pegawai,$id)
    {
         $validateData = $request->validate([
            'idpegawai' => 'required',
            'nama' => 'required',
            'tgllahir' => 'required',
            'jekel' => 'required|in:L,P',
            'alamat' => 'required',
            'tamatan' => 'required',
            'jabatan' => 'required'
        ]);

        Pegawai::where('id',$id)->update($validateData);
        return redirect('/pegawai-dash')->with('pesan','Data berhasil diupdates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(pegawai $pegawai,$id)
    {
        Pegawai::destroy($id);
        return redirect('/pegawai-dash')->with('pesan','Data berhasil hapus');

    }
}

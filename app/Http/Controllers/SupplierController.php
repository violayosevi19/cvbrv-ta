<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.supplier.index',['suppliers' => Supplier::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.supplier.create',['suppliers' => Supplier::all()]);
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
            'nonota' => 'required|unique:suppliers',
            'namasupplier' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'total' => 'required',
        ]);

        Supplier::create($validateData);
        return redirect('/supplier-dash')->with('pesan','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier,$id)
    {
        return view('dashboard.supplier.edit',['suppliers' => Supplier::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplier $supplier,$id)
    {
          $validateData=$request->validate([
            'nonota' => 'required',
            'namasupplier' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'total' => 'required',
        ]);

        Supplier::where('id',$id)->update($validateData);
        return redirect('/supplier-dash')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier,$id)
    {
        Supplier::destroy($id);
        return redirect('/supplier-dash')->with('pesan','Data berhasil dihapus');
    }
}

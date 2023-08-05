<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
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
            'kodesupplier' => 'required|unique:suppliers',
            'namasupplier' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
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
    public function show(supplier $supplier,$nonota)
    {
        $takeDataSupplier = supplier::where('nonota','=',$nonota)->get()->all();
        $produk = supplier::with('barangMasuk')
        ->get()->toArray();

        $dataProduk = [];
        foreach($produk as $data){
           foreach($data['barang_masuk'] as $value){
                $dataProduk[] = [
                    'kodeproduk' => $value['kodeproduk'],
                    'namaproduk' => $value['namaproduk']
                ];
           }
        }
        // Get unique entries based on 'kodeproduk'
        $ambilProdukUnik = array_unique($dataProduk, SORT_REGULAR);
        // If you need to reset the keys of the resulting array
        $result = array_values($ambilProdukUnik);
        // dd($uniqueDataProduk,$uniqueDataProduk);
        return view('dashboard.supplier.read',[
            'detailSupplier' => $takeDataSupplier,
            'produks' => $result
        ]);
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
            'kodesupplier' => 'required',
            'nonota' => 'required',
            'namasupplier' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
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
        return redirect('/supplier-dash');
    }
}

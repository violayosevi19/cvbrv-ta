<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\faktur;
use App\Models\detailpesanan;
use Illuminate\Http\Request;

class FakturControllerDash extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tglJatuhTempo = faktur::pluck('jatuhtempo','namatoko'); 
        $now = date('Y-m-d',strtotime(now()));
        $message =  [];
        foreach($tglJatuhTempo as $namaToko => $tglJatuhTempo){
            if($tglJatuhTempo === $now){
                $message[] = "Faktur toko $namaToko sudah jatuh tempo";
            } 
        }
    
        return view('dashboard.faktur.index',[
                    'fakturs' => Faktur::all(),
                    'alertJatuhTempo' => $message
                ]);
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
            'namatoko' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'keterangan' => 'required',
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
    // public function show(faktur $faktur,$nonota)
    // {
    //     $takeNota = detailpesanan::where('nonota','=',$nonota)->get()->all();
    //     $namaToko = faktur::where('nonota','=', $nonota)->get()->toArray();
    //     $total = detailpesanan::where('nonota','=',$nonota)->sum(\DB::raw('jumlah*harga'));
    //     // dd($namaToko[0]['namatoko']);
    //     // $takeData = detailpesanan::find($id);
    //     // dd($takeData);
    //     // dd($takeNota);
        
    //     if(!$takeNota){
    //         $errorMessage = 'Terjadi kesalahan dalam memproses data.';
    //         session()->flash('error', $errorMessage);
    //         return redirect('/faktur-dash');
    //     } else {
    //         return view('dashboard.detailorderan.readorderan',[
    //             'takeNotas' => $takeNota,
    //             'total' => $total,
    //             'namaToko' => $namaToko[0]['namatoko']
    //         ]);
    //     }
        
    // }

    public function show(Faktur $faktur,$nonota)
    {
        $detailProduks = Detailpesanan::select(
            'kodeproduk',
            'namaproduk',
            'kuantitas',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->toArray();
        $detailToko = Detailpesanan::select('namatoko','alamat','tglfaktur','nonota','jatuhtempo','namasales')->distinct()->get()->toArray();
        $totalProdukPerNonota =  Detailpesanan::select(
            'kodeproduk',
            'namaproduk',
            'kuantitas',
            'satuan',
            'harga',
            'diskon',
            'jumlah')
            ->where('nonota','=',$nonota)->get()->count();;
        $totalFaktur = detailpesanan::where('nonota',$nonota)->sum(\DB::raw('jumlah-diskon'));

        return view('dashboard.detailorderan.readorderan',[
            'detailtokos' => $detailToko,
            'detailproduks' => $detailProduks,
            'totaldatapernota' => $totalProdukPerNonota,
            'bayar' => $totalFaktur 
        ]);
        
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
            'namatoko' => 'required',
            'tglfaktur' => 'required',
            'jatuhtempo' => 'required',
            'keterangan' => 'required',
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

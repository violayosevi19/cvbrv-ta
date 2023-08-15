<?php

namespace App\Http\Controllers;

use App\Models\LabaRugi;
use App\Models\Faktur;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return view('dashboard.labarugi.index',['labarugis' => LabaRugi::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.labarugi.create',['penjualans' => Penjualan::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'tglmulai' => 'required',
    //         'tglakhir' => 'required',
    //         'modal' => 'required',
    //         'biayalistrik' => 'required',
    //         'gajikaryawan' => 'required',
    //         'biayaATK' => "required",
    //         'biayaoperasional' => 'required',
    //         'biayainternet' => 'required'
    //     ]);
    //     $gajikaryawan = (int) str_replace(['Rp', '.','.', ','], '', $validateData['gajikaryawan']);
    //     $biayalistik = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayalistrik']);
    //     $biayaATK = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayaATK']);
    //     $biayaoperasional = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayaoperasional']);
    //     $biayainternet = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayainternet']);
    //     $modal = (int) str_replace(['Rp', '.','.', ','], '', $validateData['modal']);
    //     // Gantikan nilai gajikaryawan dalam $validateData dengan nilai yang sudah di-parse
    //     $validateData['gajikaryawan'] = $gajikaryawan;
    //     $validateData['biayalistrik'] = $biayalistik;
    //     $validateData['biayaATK'] = $biayaATK;
    //     $validateData['biayaoperasional'] = $biayaoperasional;
    //     $validateData['biayainternet'] = $biayainternet;
    //     $validateData['modal'] = $modal;
    //     LabaRugi::create($validateData);
    //     return redirect('/labarugi-dash')->with('pesan','Data berhasil ditambahkan');
    // }

    public function store(Request $request)
{
    $validateData = $request->validate([
        'tglmulai' => 'required',
        'tglakhir' => 'required',
        'modal' => 'required',
        'biayalistrik' => 'required',
        'gajikaryawan' => 'required',
        'biayaATK' => "required",
        'biayaoperasional' => 'required',
        'biayainternet' => 'required'
    ]);

    $gajikaryawan = (int) str_replace(['Rp', '.','.', ','], '', $validateData['gajikaryawan']);
    $biayalistrik = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayalistrik']);
    $biayaATK = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayaATK']);
    $biayaoperasional = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayaoperasional']);
    $biayainternet = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayainternet']);
    $modal = (int) str_replace(['Rp', '.','.', ','], '', $validateData['modal']);
    
    // Gantikan nilai-nilai dalam $validateData dengan nilai yang sudah di-parse
    $validateData['gajikaryawan'] = $gajikaryawan;
    $validateData['biayalistrik'] = $biayalistrik;
    $validateData['biayaATK'] = $biayaATK;
    $validateData['biayaoperasional'] = $biayaoperasional;
    $validateData['biayainternet'] = $biayainternet;
    $validateData['modal'] = $modal;

    // Simpan data LabaRugi
    $labarugi = LabaRugi::create($validateData);

    // Hitung pengeluaran dan pendapatan per bulan
    $penjualanBulan = faktur::whereBetween('tglfaktur', [$validateData['tglmulai'], $validateData['tglakhir']])->get();
    $totalPendapatan = $penjualanBulan->sum('total');
    $totalPengeluaran = $gajikaryawan + $biayalistrik + $biayaATK + $biayaoperasional + $biayainternet;
    $labaSebelumPajak = 0;
    $labaSetelahPajak = 0;
    $rugiSebelumPajak = 0;
    $RugiSetelahPajak = 0;
    if($totalPendapatan < $totalPengeluaran){
        $rugiSebelumPajak = $totalPengeluaran-$totalPendapatan;
        $pajak = 0.1 * $rugiSebelumPajak;
        $RugiSetelahPajak = $rugiSebelumPajak - $pajak;

    } else {
        $labaSebelumPajak = $totalPendapatan - $totalPengeluaran;
        $pajak = 0.1 * $labaSebelumPajak;
        $labaSetelahPajak = $labaSebelumPajak - $pajak;
    }

   
    

    // Simpan data hasil perhitungan
    $labarugi->update([
        'total_pendapatan' => $totalPendapatan,
        'total_pengeluaran' => $totalPengeluaran,
        'laba_sebelum_pajak' => $labaSebelumPajak,
        'pajak' => $pajak,
        'laba_setelah_pajak' => $labaSetelahPajak,
        'rugi_sebelum_pajak' => $rugiSebelumPajak,
        'rugi_setelah_pajak' => $RugiSetelahPajak,
    ]);

    return redirect('/labarugi-dash')->with('pesan','Data berhasil ditambahkan');
}


    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LabaRugi  $labaRugi
     * @return \Illuminate\Http\Response
     */
    public function show(LabaRugi $labaRugi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LabaRugi  $labaRugi
     * @return \Illuminate\Http\Response
     */
    public function edit(LabaRugi $labaRugi, $id)
    {
        return view('dashboard.labarugi.edit',['labarugi' => LabaRugi::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LabaRugi  $labaRugi
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, LabaRugi $labaRugi, $id)
    // {
    //     $validateData = $request->validate([
    //         'tglmulai' => 'required',
    //         'tglakhir' => 'required',
    //         'modal' => 'required',
    //         'biayalistrik' => 'required',
    //         'gajikaryawan' => 'required',
    //         'biayaATK' => "required",
    //         'biayaoperasional' => 'required',
    //         'biayainternet' => 'required'
    //     ]);
    //     $gajikaryawan = (int) str_replace(['Rp', '.','.', ','], '', $validateData['gajikaryawan']);
    //     $biayalistik = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayalistrik']);
    //     $biayaATK = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayaATK']);
    //     $biayaoperasional = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayaoperasional']);
    //     $biayainternet = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayainternet']);
    //     $modal = (int) str_replace(['Rp', '.','.', ','], '', $validateData['modal']);
    //     // Gantikan nilai gajikaryawan dalam $validateData dengan nilai yang sudah di-parse
    //     $validateData['gajikaryawan'] = $gajikaryawan;
    //     $validateData['biayalistrik'] = $biayalistik;
    //     $validateData['biayaATK'] = $biayaATK;
    //     $validateData['biayaoperasional'] = $biayaoperasional;
    //     $validateData['biayainternet'] = $biayainternet;
    //     $validateData['modal'] = $modal;
    //     LabaRugi::where('id', $id)->update($validateData);
    //     return redirect('/labarugi-dash')->with('pesan','Data berhasil diupdate');
    // }

    public function update(Request $request, LabaRugi $labaRugi, $id)
{
    $validateData = $request->validate([
        'tglmulai' => 'required',
        'tglakhir' => 'required',
        'modal' => 'required',
        'biayalistrik' => 'required',
        'gajikaryawan' => 'required',
        'biayaATK' => "required",
        'biayaoperasional' => 'required',
        'biayainternet' => 'required'
    ]);

    $gajikaryawan = (int) str_replace(['Rp', '.','.', ','], '', $validateData['gajikaryawan']);
    $biayalistrik = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayalistrik']);
    $biayaATK = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayaATK']);
    $biayaoperasional = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayaoperasional']);
    $biayainternet = (int) str_replace(['Rp', '.','.', ','], '', $validateData['biayainternet']);
    $modal = (int) str_replace(['Rp', '.','.', ','], '', $validateData['modal']);
    
    // Gantikan nilai-nilai dalam $validateData dengan nilai yang sudah di-parse
    $validateData['gajikaryawan'] = $gajikaryawan;
    $validateData['biayalistrik'] = $biayalistrik;
    $validateData['biayaATK'] = $biayaATK;
    $validateData['biayaoperasional'] = $biayaoperasional;
    $validateData['biayainternet'] = $biayainternet;
    $validateData['modal'] = $modal;

    $labaRugi = LabaRugi::where('id',$id);
    // Simpan data LabaRugi yang sudah diperbarui
    $labaRugi->update($validateData);

    // Hitung pengeluaran dan pendapatan per bulan
    $penjualanBulan = faktur::whereBetween('diterimapada', [$validateData['tglmulai'], $validateData['tglakhir']])->get();
    $totalPendapatan = $penjualanBulan->sum('total');
    $totalPengeluaran = $gajikaryawan + $biayalistrik + $biayaATK + $biayaoperasional + $biayainternet;
    $labaSebelumPajak = 0;
    $labaSetelahPajak = 0;
    $rugiSebelumPajak = 0;
    $RugiSetelahPajak = 0;
    if($totalPendapatan < $totalPengeluaran){
        $rugiSebelumPajak = $totalPengeluaran-$totalPendapatan;
        $pajak = 0.1 * $rugiSebelumPajak;
        $RugiSetelahPajak = $rugiSebelumPajak - $pajak;

    } else {
        $labaSebelumPajak = $totalPendapatan - $totalPengeluaran;
        $pajak = 0.1 * $labaSebelumPajak;
        $labaSetelahPajak = $labaSebelumPajak - $pajak;

    }
    // dd($totalPendapatan, $totalPengeluaran,$labaSebelumPajak,$pajak,$labaSetelahPajak);


    $labaRugi->update([
        'total_pendapatan' => $totalPendapatan,
        'total_pengeluaran' => $totalPengeluaran,
        'laba_sebelum_pajak' => $labaSebelumPajak,
        'pajak' => $pajak,
        'laba_setelah_pajak' => $labaSetelahPajak,
        'rugi_sebelum_pajak' => $rugiSebelumPajak,
        'rugi_setelah_pajak' => $RugiSetelahPajak,
    ]);

    return redirect('/labarugi-dash')->with('pesan','Data berhasil diubah');
}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LabaRugi  $labaRugi
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabaRugi $labaRugi,$id)
    {
        LabaRugi::destroy($id);
    }

}

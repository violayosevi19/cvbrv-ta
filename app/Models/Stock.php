<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function produk(){
        return $this->belongsTo(produk::class);
    }

    public function barangMasuk(){
        return $this->belongsTo(BarangMasuk::class,'kodeproduk','kodeproduk');
    }

    public function detailPesanan(){
        return $this->belongsTo(detailpesanan::class,'kodeproduk','kodeproduk');
    }
}

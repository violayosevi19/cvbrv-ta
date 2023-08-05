<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $guarded=[];
    public function jenisproduk(){
    	 return $this->belongsTo(Jenisproduk::class);
    }

    public function supplier(){
        return $this->belongsTo(supplier::class,'kodeproduk','kodeproduk');
    }

    public function detailPesanan(){
        return $this->belongsTo(detailpesanan::class,'kodeproduk','kodeproduk');
    }

    public function stock(){
        return $this->hasMany(Stock::class,'kodeproduk','kodeproduk');
    }

    public function barangMasuk(){
        return $this->hasMany(BarangMasuk::class,'kodeproduk','kodeproduk');
    }
}

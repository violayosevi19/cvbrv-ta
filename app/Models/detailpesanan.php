<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailpesanan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function faktur() {
        return $this->belongsTo(faktur::class,'nonota','nonota');
    }

    public function produk() {
        return $this->hasMany(produk::class,'kodeproduk', 'kodeproduk');
    }

    public function stock() {
        return $this->hasMany(Stock::class,'kodeproduk', 'kodeproduk');
    }

    public function toko() {
        return $this->belongsTo(toko::class,'nonota', 'nonota');
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faktur extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function detailPesanan() {
        return $this->hasMany(detailpesanan::class,'nonota','nonota');
    }

    public function penjualan() {
        return $this->hasOne(penjualan::class,'nonota','nonota');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
     protected $guarded=[];

     public function faktur() {
        return $this->hasMany(faktur::class,'nonota','nonota');
    }
}


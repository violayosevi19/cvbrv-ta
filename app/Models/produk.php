<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class produk extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function jenisproduk(){
    	 return $this->belongsTo(Jenisproduk::class);
    }

    public function supplier(){
        return $this->hasMany(supplier::class,'kodeproduk','kodeproduk');
   }
}

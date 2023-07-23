<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function detailpesanans(){
        return $this->hasMany(detailpesanan::class,'nonota','nonota');
    }
}

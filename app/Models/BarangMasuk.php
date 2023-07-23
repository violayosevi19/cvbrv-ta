<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock(){
        return $this->hasMany(Stock::class,'kodeproduk','kodeproduk');
    }
}

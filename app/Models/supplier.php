<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function produk(){
        return $this->hasMany(produk::class);
    }

    public function barangMasuk() {
        return $this->hasMany(BarangMasuk::class, 'nonota', 'nonota');
    }
}

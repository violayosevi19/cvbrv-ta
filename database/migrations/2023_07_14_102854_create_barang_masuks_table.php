<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->char('kodeproduk',12)->nullable();
            $table->string('namaproduk',50)->nullable();
            $table->string('namasupplier',50);
            $table->char('nonota',12);
            $table->integer('harga')->nullable();
            $table->integer('stock')->nullable();
            $table->char('satuan',12)->nullable();
            $table->decimal('diskon')->nullable();
            $table->decimal('jumlah')->nullable();
            $table->date('tanggalmasuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_masuks');
    }
};

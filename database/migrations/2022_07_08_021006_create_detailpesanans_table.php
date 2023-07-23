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
        Schema::create('detailpesanans', function (Blueprint $table) {
            $table->id();
            $table->char('nonota',12);
            $table->char('kodeproduk',12);
            $table->string('namatoko',50);
            $table->string('alamat')->nullable();
            $table->string('tglfaktur');
            $table->string('jatuhtempo',20);
            $table->string('namasales');
            $table->string('namaproduk',50);
            $table->integer('kuantitas');
            $table->char('satuan',12);
            $table->integer('harga');
            $table->decimal('diskon')->nullable();
            $table->integer('jumlah');
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
        Schema::dropIfExists('detailpesanans');
    }
};

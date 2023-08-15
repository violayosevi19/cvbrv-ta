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
        Schema::create('laba_rugis', function (Blueprint $table) {
            $table->id();
            $table->date('tglmulai');
            $table->date('tglakhir');
            $table->integer('modal');
            $table->integer('biayalistrik');
            $table->integer('gajikaryawan');
            $table->integer('biayaoperasional');
            $table->integer('biayaATK');
            $table->integer('biayainternet');
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
        Schema::dropIfExists('laba_rugis');
    }
};

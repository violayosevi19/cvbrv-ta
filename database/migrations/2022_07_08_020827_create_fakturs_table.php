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
        Schema::create('fakturs', function (Blueprint $table) {
            $table->id();                                   
            $table->char('nonota',12)->unique();
            $table->string('namatoko');
            $table->date('tglfaktur');
            $table->date('jatuhtempo');
            $table->string('keterangan')->nullable();
            $table->double('total',10,2);
            $table->string('pembayaran',50);
            $table->boolean('status_diterima')->default(false);
            $table->string('sopir',15);
            $table->string('penerima',20)->nullable();
            $table->string('file')->nullable();
            $table->date('diterimapada')->nullable();
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
        Schema::dropIfExists('fakturs');
    }
};

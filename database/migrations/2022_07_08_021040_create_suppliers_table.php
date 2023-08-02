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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->char('kodesupplier',12)->nullable()->unique();
            $table->char('nonota',12)->nullable()->unique();
            $table->string('namasupplier',50)->nullable();
            $table->char('nohp',12)->nullable();
            $table->text('alamat')->nullable();
            $table->date('tglfaktur')->nullable();
            $table->date('jatuhtempo')->nullable();
            $table->double('total',10,2)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};

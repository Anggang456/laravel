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
        Schema::create('pesanan_detail', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('produk_id');
            $table->unsignedInteger('pesanan_id');
            $table->integer('jumlah');
            $table->integer('jumlah_harga');
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->foreign('pesanan_id')->references('id')->on('pesanan');
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
        Schema::dropIfExists('pesanan_detail');
    }
};

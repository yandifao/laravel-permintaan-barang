<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permintaan_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('permintaan_barang_id')->foreign('permintaan_barang_id')->references('id')->on('permintaan_barang');
            $table->string('kode_barang')->foreign('kode_barang')->references('kode_barang')->on('barang');
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_barang_detail');
    }
};

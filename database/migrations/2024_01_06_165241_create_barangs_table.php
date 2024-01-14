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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode_barang')->primary();
            $table->string('nama_barang');
            $table->integer('lokasi_id')->foreign('lokasi_id')->references('id')->on('lokasi_barang');
            $table->string('stock');
            $table->string('satuan_id')->foreign('satuan_id')->references('id')->on('satuan_barang');
            $table->string('keterangan');
            $table->integer('status')->default(1)->comment('1:digunakan, 0:tidak digunakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

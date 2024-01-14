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
        Schema::create('permintaan_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('tanggal')->length(50);
            $table->integer('status')->default(0)->comment('0: Pending, 1: Processed, 2: Rejected');
            $table->string('keterangan')->nullable();
            $table->string('processed_by')->nullable();
            $table->datetime('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_barang');
    }
};

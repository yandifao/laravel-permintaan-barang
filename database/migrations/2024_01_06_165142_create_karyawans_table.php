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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('nik')->primary();
            $table->integer('departemen_id')->foreign('departemen_id')->references('id')->on('departemen');
            $table->string('nama');
            $table->string('jkel');
            $table->integer('status')->default(1)->comment('1:aktif, 0:tidak aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBarang extends Model
{
    use HasFactory;

    protected $table = 'permintaan_barang';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'tanggal',
        'status',
        'keterangan',
        'processed_by',
        'processed_at',
        'created_at',
        'updated_at',
    ];
}

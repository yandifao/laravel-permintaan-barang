<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $primaryKey = 'kode_barang';

    protected $keyType = 'string';

    protected $fillable = [
        'kode_barang',
        'lokasi_id',
        'nama_barang',
        'stock',
        'satuan_id',
        'keterangan',
        'status',
    ];
}

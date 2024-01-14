<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBarangDetail extends Model
{
    use HasFactory;

    protected $table = 'permintaan_barang_detail';

    protected $primaryKey = 'id';

    protected $fillable = [
        'permintaan_barang_id',
        'kode_barang',
        'jumlah',
        'created_at',
        'updated_at',
    ];
}

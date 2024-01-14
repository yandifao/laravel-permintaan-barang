<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiBarang extends Model
{
    use HasFactory;

    protected $table = 'lokasi_barang';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_lokasi',
        'keterangan',
        'created_at',
        'updated_at',
    ];
}

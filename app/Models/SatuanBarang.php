<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanBarang extends Model
{
    use HasFactory;

    protected $table = 'satuan_barang';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_satuan',
        'keterangan',
        'created_at',
        'updated_at',
    ];
}

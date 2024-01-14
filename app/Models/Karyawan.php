<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $primaryKey = 'nik';

    protected $keyType = 'string';

    protected $fillable = [
        'nik',
        'nama',
        'departemen_id',
        'status',
        'created_at',
        'updated_at',
    ];
}

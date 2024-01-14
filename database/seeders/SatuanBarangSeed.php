<?php

namespace Database\Seeders;

use App\Models\SatuanBarang as ModelsSatuanBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanBarangSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_satuan' => 'PCS',
                'keterangan' => 'Pieces',
            ],
            [
                'nama_satuan' => 'BOX',
                'keterangan' => 'Box',
            ],
            [
                'nama_satuan' => 'PAK',
                'keterangan' => 'Pak',
            ],
            [
                'nama_satuan' => 'DUS',
                'keterangan' => 'Dus',
            ],
            [
                'nama_satuan' => 'LUSIN',
                'keterangan' => 'Lusin',
            ],
            [
                'nama_satuan' => 'KARUNG',
                'keterangan' => 'Karung',
            ],
            [
                'nama_satuan' => 'KOLI',
                'keterangan' => 'Koli',
            ],
            [
                'nama_satuan' => 'KARDUS',
                'keterangan' => 'Kardus',
            ],
            [
                'nama_satuan' => 'KOTAK',
                'keterangan' => 'Kotak',
            ],
            [
                'nama_satuan' => 'GROSS',
                'keterangan' => 'Gross',
            ],
            [
                'nama_satuan' => 'KALENG',
                'keterangan' => 'Kaleng',
            ],
            [
                'nama_satuan' => 'BOTOL',
                'keterangan' => 'Botol',
            ],
            [
                'nama_satuan' => 'LITER',
                'keterangan' => 'Liter',
            ],
            [
                'nama_satuan' => 'METER',
                'keterangan' => 'Meter',
            ],
            [
                'nama_satuan' => 'GRAM',
                'keterangan' => 'Gram',
            ],
            [
                'nama_satuan' => 'KILOGRAM',
                'keterangan' => 'Kilogram',
            ],
            [
                'nama_satuan' => 'TON',
                'keterangan' => 'Ton',
            ],
            [
                'nama_satuan' => 'LAINNYA',
                'keterangan' => 'Lainnya',
            ],
        ];

        ModelsSatuanBarang::insert($data);
    }
}

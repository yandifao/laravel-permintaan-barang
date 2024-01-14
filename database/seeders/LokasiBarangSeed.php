<?php

namespace Database\Seeders;

use App\Models\LokasiBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiBarangSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_lokasi' => 'L1-R1A',
                'keterangan' => 'Rak 1'
            ],
            [
                'nama_lokasi' => 'L1-R1B',
                'keterangan' => 'Rak 2'
            ],
            [
                'nama_lokasi' => 'L1-R1C',
                'keterangan' => 'Rak 3'
            ],
            [
                'nama_lokasi' => 'L1-R1D',
                'keterangan' => 'Rak 4'
            ],
            [
                'nama_lokasi' => 'L1-R1E',
                'keterangan' => 'Rak 5'
            ],
            [
                'nama_lokasi' => 'L1-R1F',
                'keterangan' => 'Rak 6'
            ],
            [
                'nama_lokasi' => 'L1-R1G',
                'keterangan' => 'Rak 7'
            ],
            [
                'nama_lokasi' => 'L1-R1H',
                'keterangan' => 'Rak 8'
            ],
            [
                'nama_lokasi' => 'L1-R1I',
                'keterangan' => 'Rak 9'
            ],
            [
                'nama_lokasi' => 'L1-R1J',
                'keterangan' => 'Rak 10'
            ],
        ];

        LokasiBarang::insert($data);
    }
}

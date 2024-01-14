<?php

namespace Database\Seeders;

use App\Models\Departemen as ModelsDepartemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartemenSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_departemen' => 'IT',
                'keterangan' => 'Departemen IT',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'Operasional',
                'keterangan' => 'Departemen Operasional',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'Keuangan',
                'keterangan' => 'Departemen Keuangan',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'HRD',
                'keterangan' => 'Departemen HRD',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'Marketing',
                'keterangan' => 'Departemen Marketing',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'Purchasing',
                'keterangan' => 'Departemen Purchasing',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'Gudang',
                'keterangan' => 'Departemen Gudang',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'Produksi',
                'keterangan' => 'Departemen Produksi',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'Quality Control',
                'keterangan' => 'Departemen Quality Control',
                'status' => 1,
            ],
            [
                'nama_departemen' => 'Pengadaan',
                'keterangan' => 'Departemen Pengadaan',
                'status' => 1,
            ],
        ];

        ModelsDepartemen::insert($data);
    }
}

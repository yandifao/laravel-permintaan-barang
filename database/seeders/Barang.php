<?php

namespace Database\Seeders;

use App\Models\Barang as ModelsBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Barang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_barang' => 'ATK0001',
                'nama_barang' => 'AMPLOP A COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 17,
                'satuan_id' => 3,
                'keterangan' => 'Amplop A Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0002',
                'nama_barang' => 'AMPLOP B COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 32,
                'satuan_id' => 3,
                'keterangan' => 'Amplop B Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0003',
                'nama_barang' => 'AMPLOP C COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 9,
                'satuan_id' => 3,
                'keterangan' => 'Amplop C Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0004',
                'nama_barang' => 'AMPLOP D COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 12,
                'satuan_id' => 3,
                'keterangan' => 'Amplop D Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0005',
                'nama_barang' => 'AMPLOP E COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 5,
                'satuan_id' => 3,
                'keterangan' => 'Amplop E Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0006',
                'nama_barang' => 'AMPLOP F COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 7,
                'satuan_id' => 3,
                'keterangan' => 'Amplop F Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0007',
                'nama_barang' => 'AMPLOP G COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 3,
                'satuan_id' => 3,
                'keterangan' => 'Amplop G Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0008',
                'nama_barang' => 'AMPLOP H COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 2,
                'satuan_id' => 3,
                'keterangan' => 'Amplop H Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0009',
                'nama_barang' => 'AMPLOP I COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 1,
                'satuan_id' => 3,
                'keterangan' => 'Amplop I Coklat Jaya',
                'status' => 1,
            ],
            [
                'kode_barang' => 'ATK0010',
                'nama_barang' => 'AMPLOP J COKLAT JAYA',
                'lokasi_id' => 1,
                'stock' => 0,
                'satuan_id' => 3,
                'keterangan' => 'Amplop J Coklat Jaya',
                'status' => 1,
            ],
        ];

        ModelsBarang::insert($data);
    }
}

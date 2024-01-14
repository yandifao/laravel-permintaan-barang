<?php

namespace Database\Seeders;

use App\Models\Karyawan as ModelsKaryawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $data = [
            [
                'nik' => '001.059.00588',
                'departemen_id' => '1',
                'nama' => 'Aam Suherman',
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '002.059.00589',
                'departemen_id' => 1,
                'nama' => 'Yandi',
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '003.059.00590',
                'departemen_id' => 1,
                'nama' => $faker->name,
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '004.059.00591',
                'departemen_id' => 1,
                'nama' => $faker->name,
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '005.059.00592',
                'departemen_id' => 1,
                'nama' => $faker->name,
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '006.059.00593',
                'departemen_id' => 1,
                'nama' => $faker->name,
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '007.059.00594',
                'departemen_id' => 1,
                'nama' => $faker->name,
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '008.059.00595',
                'departemen_id' => 1,
                'nama' => $faker->name,
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '009.059.00596',
                'departemen_id' => 1,
                'nama' => $faker->name,
                'jkel' => 'L',
                'status' => '1',
            ],
            [
                'nik' => '010.059.00597',
                'departemen_id' => 1,
                'nama' => $faker->name,
                'jkel' => 'L',
                'status' => '1',
            ],
        ];

        ModelsKaryawan::insert($data);
    }
}

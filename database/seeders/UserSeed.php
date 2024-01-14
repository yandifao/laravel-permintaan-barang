<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $data = [
            [
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'level' => 'admin',
                'nik' => '002.059.00589',
            ],
            [
                'email' => 'aam.suherman@smm.com',
                'password' => bcrypt('usersmm'),
                'level' => 'user',
                'nik' => '001.059.00588',
            ],
            [
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'level' => 'user',
                'nik' => '003.059.00590',
            ],
            [
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'level' => 'user',
                'nik' => '004.059.00591',
            ],
            [
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'level' => 'user',
                'nik' => '005.059.00592',
            ],
            [
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'level' => 'user',
                'nik' => '006.059.00593',
            ],
            [
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'level' => 'user',
                'nik' => '007.059.00594',
            ],
            [
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'level' => 'user',
                'nik' => '008.059.00595',
            ],
            [
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'level' => 'user',
                'nik' => '009.059.00596',
            ],
            [
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'level' => 'user',
                'nik' => '010.059.00597',
            ],
        ];

        ModelsUser::insert($data);
    }
}

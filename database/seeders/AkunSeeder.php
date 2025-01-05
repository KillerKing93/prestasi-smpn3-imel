<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petugas = [
            [
                'nama' => 'Petugas',
                'gender' => 'perempuan',
                'username' => 'petugas',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('smpn03bkl'),
                'profil' => 'img/smp.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($petugas as $value) {
            DB::table('petugas')->insert($value);
        }
    }
}

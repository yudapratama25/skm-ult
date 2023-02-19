<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nims = [
            '1615015124' => 'ZIQIRYA EQI PUTRA',
            '1915036114' => 'YUDA PRATAMA',
            '1615015120' => 'ABDUL AZIZ',
            '1615015121' => 'MUHAMMAD SHAUBARI',
            '1615015122' => 'HARIYANTO',
            '1615015123' => 'ALDA LATIFAH',
        ];

        foreach ($nims as $nim => $nama) {
            Mahasiswa::create([
                'nim' => $nim,
                'nama' => $nama,
                'password' => Hash::make('12345')
            ]);
        }
    }
}

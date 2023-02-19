<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nips = [
            '123456789' => 'IBU RUSLIANA',
            '987654321' => 'IBU ENNY',
            '111111111' => 'PAK LEO',
        ];

        foreach ($nips as $nip => $nama) {
            Admin::create([
                'nip' => $nip,
                'nama' => $nama,
                'password' => Hash::make('12345')
            ]);
        }
    }
}

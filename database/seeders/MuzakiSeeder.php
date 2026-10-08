<?php

namespace Database\Seeders;

use App\Models\muzaki;
use App\Models\Muzaki as ModelsMuzaki;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuzakiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Muzaki::create([
            'nama_muzaki' => 'Dasim',
            'umur'   => '50',
            'jenis_kelamin' => 'laki-laki',
            'alamat_lainnya'    => '',
            'alamat' => 'Salak Putih'
        ]);
    }
}

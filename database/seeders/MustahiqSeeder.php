<?php

namespace Database\Seeders;

use App\Models\Mustahiq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MustahiqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mustahiq::create([
            'nama_mustahiq' => 'Dasim',
            'umur'   => '50',
            'jenis_kelamin' => 'laki-laki',
            'alamat_lainnya'    => '',
            'alamat_sekarang' => 'Salak Putih'
        ]);
    }
}

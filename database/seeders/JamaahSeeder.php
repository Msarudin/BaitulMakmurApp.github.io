<?php

namespace Database\Seeders;

use App\Models\Jamaah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JamaahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jamaah::create([
            'nama_jamaah' => 'Sarudin',
            'email'        => 'efendimse@gmail.com',
            'nik'         => '13332222',
            'no_kk'         => '133',
            'no_tlp'         => '081212434417',
            'umur'        => '34',
            'alamat_sekarang'      => 'Bojong',
            'alamat_asal'      => 'Bojong',
            'tanggal_lahir' => '1991-01-01',
            'tempat_lahir'  => 'tangerang',
            'jenis_kelamin' => 'laki-laki'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Http\Controllers\JenisAmalController;
use App\Models\jenis_amal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisAmalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amal = ['Sodakoh', 'Zakat_Mal', 'Zakat_Fitrah', 'Infaq', 'Amal'];

        foreach ($amal as $item) {
            Jenis_amal::create([
                'nama_amal' => $item
            ]);
        }
    }
}

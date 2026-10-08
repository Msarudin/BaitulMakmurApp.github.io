<?php

namespace Database\Seeders;

use App\Models\ktrmustahiq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KtrmustahiqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ktrmustahiq = ['Fakir', 'Miskin', 'Amil', 'Mualaf', 'Riqab', 'Gharimin', 'Fisabilillah', 'Ibnu Sabil:/Pesantren', 'Yatim', 'Piatu', 'Yatim_Piatu'];

        foreach ($ktrmustahiq as $item) {
            ktrmustahiq::create([
                'nama_ktrmustahik' => $item
            ]);
        }
    }
}

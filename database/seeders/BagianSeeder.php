<?php

namespace Database\Seeders;

use App\Models\Bagian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bagian = ['RT_01', 'RT_02', 'RT_03', 'RT_04', 'RT_05'];

        foreach ($bagian as $item) {
            Bagian::create([
                'nama_bagian' => $item
            ]);
        }
    }
}

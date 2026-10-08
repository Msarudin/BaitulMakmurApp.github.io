<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create(['name' => 'Kas Operasional', 'slug' => 'kas-operasional']);
        Kategori::create(['name' => 'Kas Yatim', 'slug' => 'kas-yatim']);
        Kategori::create(['name' => 'Kas Ambulan', 'slug' => 'kas-ambulan']);
        Kategori::create(['name' => 'Kas Irma', 'slug' => 'kas-irma']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PelatihanKategori;

class PelatihanKategoriSeeder extends Seeder
{
    public function run()
    {
        PelatihanKategori::insert([
            ['nama' => 'Pendampingan'],
            ['nama' => 'Pembekalan'],
            ['nama' => 'Sertifikasi'],
            ['nama' => 'Workshop'],
            ['nama' => 'Lainnya'],
        ]);
    }
}

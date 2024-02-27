<?php

namespace Database\Seeders;

use App\Models\JenisBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisBarangs = [
            ['nama' => 'Konsumsi'],
            ['nama' => 'Pembersih'],
        ];

        foreach ($jenisBarangs as $jenisBarang) {
            JenisBarang::create($jenisBarang);
        }
    }
}

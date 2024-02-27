<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            ['nama_barang' => 'Kopi', 'jenis_barang_id' => 1, 'stok' => 100],
            ['nama_barang' => 'Teh', 'jenis_barang_id' => 1, 'stok' => 100],
            ['nama_barang' => 'Pasta Gigi', 'jenis_barang_id' => 2, 'stok' => 100],
            ['nama_barang' => 'Sabun Mandi', 'jenis_barang_id' => 2, 'stok' => 100],
            ['nama_barang' => 'Sampo', 'jenis_barang_id' => 2, 'stok' => 100],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}

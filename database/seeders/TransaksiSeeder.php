<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataTransaksi = [
            [
                'barang_id' => 1,
                'quantity' => 10
            ],
            [
                'barang_id' => 2,
                'quantity' => 19
            ],
            [
                'barang_id' => 1,
                'quantity' => 15
            ],
            [
                'barang_id' => 3,
                'quantity' => 20
            ],
            [
                'barang_id' => 4,
                'quantity' => 30
            ],
            [
                'barang_id' => 5,
                'quantity' => 25
            ],
            [
                'barang_id' => 2,
                'quantity' => 5
            ],
        ];

        foreach ($dataTransaksi as $data) {
            $barang = Barang::findOrFail($data['barang_id']);

            $transaksi = Transaksi::create([
                'barang_id' => $data['barang_id'],
                'quantity' => $data['quantity'],
                'stok_sisa' => $barang->stok
            ]);

            $transaksi->barang()->update([
                'stok' => $transaksi->barang->stok - $data['quantity']
            ]);
        }
    }
}

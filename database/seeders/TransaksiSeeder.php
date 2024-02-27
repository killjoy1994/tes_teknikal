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
        $transaksi = [
            ['barang_id' => 6, 'tanggal_transaksi' => '2021-05-01', 'quantity' => 10],
            ['barang_id' => 7, 'tanggal_transaksi' => '2021-05-05', 'quantity' => 19],
            ['barang_id' => 6, 'tanggal_transaksi' => '2021-05-10', 'quantity' => 15],
            ['barang_id' => 8, 'tanggal_transaksi' => '2021-05-11', 'quantity' => 20],
            ['barang_id' => 9, 'tanggal_transaksi' => '2021-05-11', 'quantity' => 30],
            ['barang_id' => 10, 'tanggal_transaksi' => '2021-05-12', 'quantity' => 25],
            ['barang_id' => 7, 'tanggal_transaksi' => '2021-05-12', 'quantity' => 5],
        ];

        foreach ($transaksi as $data) {
            $transaction = new Transaksi([
                'quantity' => $data['quantity'],
                'barang_id' => $data['barang_id'],
                'created_at' => $data['tanggal_transaksi'],
            ]);
            $transaction->save();

            // Update stock barang
            $barang = Barang::find($data['barang_id']);
            if ($barang) {
                $barang->stok -= $data['quantity'];
                $barang->save();
            }
        }
    }
}

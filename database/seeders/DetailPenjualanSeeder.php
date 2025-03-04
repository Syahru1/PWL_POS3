<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Penjualan 1 dengan 3 barang
            ['penjualan_id' => 1, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 2],
            ['penjualan_id' => 1, 'barang_id' => 2, 'harga' => 75000, 'jumlah' => 1],
            ['penjualan_id' => 1, 'barang_id' => 3, 'harga' => 100000, 'jumlah' => 1],

            // Penjualan 2 dengan 3 barang
            ['penjualan_id' => 2, 'barang_id' => 4, 'harga' => 20000, 'jumlah' => 5],
            ['penjualan_id' => 2, 'barang_id' => 5, 'harga' => 15000, 'jumlah' => 3],
            ['penjualan_id' => 2, 'barang_id' => 6, 'harga' => 30000, 'jumlah' => 2],

            // Penjualan 3 dengan 3 barang
            ['penjualan_id' => 3, 'barang_id' => 7, 'harga' => 5000, 'jumlah' => 10],
            ['penjualan_id' => 3, 'barang_id' => 8, 'harga' => 8000, 'jumlah' => 7],
            ['penjualan_id' => 3, 'barang_id' => 9, 'harga' => 12000, 'jumlah' => 4],

            // Penjualan 4 dengan 3 barang
            ['penjualan_id' => 4, 'barang_id' => 10, 'harga' => 25000, 'jumlah' => 3],
            ['penjualan_id' => 4, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 1],
            ['penjualan_id' => 4, 'barang_id' => 2, 'harga' => 75000, 'jumlah' => 2],

            // Penjualan 5 dengan 3 barang
            ['penjualan_id' => 5, 'barang_id' => 3, 'harga' => 100000, 'jumlah' => 1],
            ['penjualan_id' => 5, 'barang_id' => 4, 'harga' => 20000, 'jumlah' => 2],
            ['penjualan_id' => 5, 'barang_id' => 5, 'harga' => 15000, 'jumlah' => 4],

            // Penjualan 6 hingga 10 (setiap penjualan ada 3 barang)
            ['penjualan_id' => 6, 'barang_id' => 6, 'harga' => 30000, 'jumlah' => 2],
            ['penjualan_id' => 6, 'barang_id' => 7, 'harga' => 5000, 'jumlah' => 6],
            ['penjualan_id' => 6, 'barang_id' => 8, 'harga' => 8000, 'jumlah' => 3],

            ['penjualan_id' => 7, 'barang_id' => 9, 'harga' => 12000, 'jumlah' => 5],
            ['penjualan_id' => 7, 'barang_id' => 10, 'harga' => 25000, 'jumlah' => 1],
            ['penjualan_id' => 7, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 2],

            ['penjualan_id' => 8, 'barang_id' => 2, 'harga' => 75000, 'jumlah' => 1],
            ['penjualan_id' => 8, 'barang_id' => 3, 'harga' => 100000, 'jumlah' => 1],
            ['penjualan_id' => 8, 'barang_id' => 4, 'harga' => 20000, 'jumlah' => 3],

            ['penjualan_id' => 9, 'barang_id' => 5, 'harga' => 15000, 'jumlah' => 2],
            ['penjualan_id' => 9, 'barang_id' => 6, 'harga' => 30000, 'jumlah' => 4],
            ['penjualan_id' => 9, 'barang_id' => 7, 'harga' => 5000, 'jumlah' => 8],

            ['penjualan_id' => 10, 'barang_id' => 8, 'harga' => 8000, 'jumlah' => 6],
            ['penjualan_id' => 10, 'barang_id' => 9, 'harga' => 12000, 'jumlah' => 3],
            ['penjualan_id' => 10, 'barang_id' => 10, 'harga' => 25000, 'jumlah' => 1],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Televisi', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Kulkas', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG003', 'barang_nama' => 'Kaos Polos', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG004', 'barang_nama' => 'Jaket', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG005', 'barang_nama' => 'Beras 5Kg', 'harga_beli' => 50000, 'harga_jual' => 70000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG006', 'barang_nama' => 'Minyak Goreng', 'harga_beli' => 12000, 'harga_jual' => 15000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG007', 'barang_nama' => 'Piring', 'harga_beli' => 5000, 'harga_jual' => 8000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG008', 'barang_nama' => 'Sendok Garpu', 'harga_beli' => 2000, 'harga_jual' => 5000],
            ['kategori_id' => 5, 'barang_kode' => 'BRG009', 'barang_nama' => 'Buku Tulis', 'harga_beli' => 3000, 'harga_jual' => 5000],
            ['kategori_id' => 5, 'barang_kode' => 'BRG010', 'barang_nama' => 'Pensil', 'harga_beli' => 1000, 'harga_jual' => 2000],
        ];

        DB::table('m_barang')->insert($data);
    }
}

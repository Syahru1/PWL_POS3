<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $suplier = [
            [
                'nama_suplier' => 'PT Maju Jaya',
                'kontak' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'CV Sumber Berkah',
                'kontak' => '081987654321',
                'alamat' => 'Jl. Sejahtera No. 22, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'UD Sukses Makmur',
                'kontak' => '082112233445',
                'alamat' => 'Jl. Harmoni No. 5, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'PT Cahaya Abadi',
                'kontak' => '081322334455',
                'alamat' => 'Jl. Kenangan No. 12, Medan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'CV Berkat Sejahtera',
                'kontak' => '081566778899',
                'alamat' => 'Jl. Pelangi No. 88, Makassar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'UD Sentosa',
                'kontak' => '081998877665',
                'alamat' => 'Jl. Kemakmuran No. 77, Yogyakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'PT Langgeng Jaya',
                'kontak' => '082244556677',
                'alamat' => 'Jl. Melati No. 5, Semarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'CV Harmoni Mandiri',
                'kontak' => '083355667788',
                'alamat' => 'Jl. Anggrek No. 30, Bali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'PT Sejahtera Bersama',
                'kontak' => '085566778899',
                'alamat' => 'Jl. Bahagia No. 20, Balikpapan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_suplier' => 'UD Tunas Harapan',
                'kontak' => '086677889900',
                'alamat' => 'Jl. Surya No. 99, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('m_suplier')->insert($suplier);
    }
}

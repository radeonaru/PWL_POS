<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'user_id' => 3, 'pembeli' => 'Budi', 'penjualan_kode' => 'PEN001', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 2, 'user_id' => 3, 'pembeli' => 'Bagas', 'penjualan_kode' => 'PEN002', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Luis', 'penjualan_kode' => 'PEN003', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 4, 'user_id' => 3, 'pembeli' => 'Dika', 'penjualan_kode' => 'PEN004', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 5, 'user_id' => 3, 'pembeli' => 'Huda', 'penjualan_kode' => 'PEN005', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 6, 'user_id' => 3, 'pembeli' => 'Dimas', 'penjualan_kode' => 'PEN006', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 7, 'user_id' => 3, 'pembeli' => 'Rusdi', 'penjualan_kode' => 'PEN007', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 8, 'user_id' => 3, 'pembeli' => 'Tono', 'penjualan_kode' => 'PEN008', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Hisyam', 'penjualan_kode' => 'PEN009', 'penjualan_tanggal' => '2024-03-07'],
            ['penjualan_id' => 10, 'user_id' => 3, 'pembeli' => 'Heri', 'penjualan_kode' => 'PEN010', 'penjualan_tanggal' => '2024-03-07'],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}

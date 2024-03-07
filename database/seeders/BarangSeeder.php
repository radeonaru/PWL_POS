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
            ['barang_id' => 1, 'barang_kode' => 'BRG001', 'kategori_id' => 1, 'barang_nama' => 'Smartphone', 'harga_beli' => 1000000, 'harga_jual' => 1500000],
            ['barang_id' => 2, 'barang_kode' => 'BRG002', 'kategori_id' => 1, 'barang_nama' => 'Laptop', 'harga_beli' => 3000000, 'harga_jual' => 4000000],
            ['barang_id' => 3, 'barang_kode' => 'BRG003', 'kategori_id' => 2, 'barang_nama' => 'Kemeja', 'harga_beli' => 500000, 'harga_jual' => 700000],
            ['barang_id' => 4, 'barang_kode' => 'BRG004', 'kategori_id' => 2, 'barang_nama' => 'Celana Panjang', 'harga_beli' => 400000, 'harga_jual' => 600000],
            ['barang_id' => 5, 'barang_kode' => 'BRG005', 'kategori_id' => 3, 'barang_nama' => 'Panci', 'harga_beli' => 100000, 'harga_jual' => 150000],
            ['barang_id' => 6, 'barang_kode' => 'BRG006', 'kategori_id' => 3, 'barang_nama' => 'Sendok Garpu Set', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 7, 'barang_kode' => 'BRG007', 'kategori_id' => 4, 'barang_nama' => 'Oli Mesin', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 8, 'barang_kode' => 'BRG008', 'kategori_id' => 4, 'barang_nama' => 'Wiper Blade', 'harga_beli' => 30000, 'harga_jual' => 50000],
            ['barang_id' => 9, 'barang_kode' => 'BRG009', 'kategori_id' => 5, 'barang_nama' => 'Bola Sepak', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 10, 'barang_kode' => 'BRG010', 'kategori_id' => 5, 'barang_nama' => 'Sepeda Lipat', 'harga_beli' => 1000000, 'harga_jual' => 1500000],
        ];

        DB::table('m_barang')->insert($data);
    }
}

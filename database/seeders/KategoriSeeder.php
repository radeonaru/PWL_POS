<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // ['kategori_id' => 1, 'kategori_kode' => 'KTG001', 'kategori_nama' => 'Elektronik'],
            // ['kategori_id' => 2, 'kategori_kode' => 'KTG002', 'kategori_nama' => 'Pakaian'],
            // ['kategori_id' => 3, 'kategori_kode' => 'KTG003', 'kategori_nama' => 'Alat Rumah Tangga'],
            // ['kategori_id' => 4, 'kategori_kode' => 'KTG004', 'kategori_nama' => 'Otomotif'],
            // ['kategori_id' => 5, 'kategori_kode' => 'KTG005', 'kategori_nama' => 'Olahraga'],
            ['kategori_id' => 6, 'kategori_kode' => 'CML', 'kategori_nama' => 'Cemilan'],
            ['kategori_id' => 7, 'kategori_kode' => 'MNR', 'kategori_nama' => 'Minuman Ringan'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}

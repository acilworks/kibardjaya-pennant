<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['province' => 'DI Yogyakarta', 'cost' => 10000],
            ['province' => 'Jawa Tengah', 'cost' => 14000],
            ['province' => 'Jawa Timur', 'cost' => 18000],
            ['province' => 'Jawa Barat', 'cost' => 20000],
            ['province' => 'DKI Jakarta', 'cost' => 19000],
            ['province' => 'Banten', 'cost' => 20000],
            ['province' => 'Lampung', 'cost' => 24000],
            ['province' => 'Sumatera Selatan', 'cost' => 30000],
            ['province' => 'Jambi', 'cost' => 31000],
            ['province' => 'Bengkulu', 'cost' => 32000],
            ['province' => 'Riau', 'cost' => 33000],
            ['province' => 'Sumatera Barat', 'cost' => 33000],
            ['province' => 'Sumatera Utara', 'cost' => 35000],
            ['province' => 'Aceh', 'cost' => 38000],
            ['province' => 'Bangka Belitung', 'cost' => 35000],
            ['province' => 'Kepulauan Riau', 'cost' => 37000],
            ['province' => 'Kalimantan Selatan', 'cost' => 35000],
            ['province' => 'Kalimantan Tengah', 'cost' => 36000],
            ['province' => 'Kalimantan Barat', 'cost' => 37000],
            ['province' => 'Kalimantan Timur', 'cost' => 39000],
            ['province' => 'Kalimantan Utara', 'cost' => 42000],
            ['province' => 'Sulawesi Selatan', 'cost' => 42000],
            ['province' => 'Sulawesi Tengah', 'cost' => 43000],
            ['province' => 'Sulawesi Tenggara', 'cost' => 44000],
            ['province' => 'Gorontalo', 'cost' => 45000],
            ['province' => 'Sulawesi Barat', 'cost' => 44000],
            ['province' => 'Sulawesi Utara', 'cost' => 46000],
            ['province' => 'Bali', 'cost' => 24000],
            ['province' => 'Nusa Tenggara Barat', 'cost' => 32000],
            ['province' => 'Nusa Tenggara Timur', 'cost' => 38000],
            ['province' => 'Maluku', 'cost' => 50000],
            ['province' => 'Maluku Utara', 'cost' => 52000],
            ['province' => 'Papua Barat', 'cost' => 56000],
            ['province' => 'Papua Barat Daya', 'cost' => 56000],
            ['province' => 'Papua', 'cost' => 60000],
            ['province' => 'Papua Tengah', 'cost' => 62000],
            ['province' => 'Papua Pegunungan', 'cost' => 65000],
            ['province' => 'Papua Selatan', 'cost' => 62000]
        ];

        foreach ($data as $row) {
            \App\Models\ShippingProvince::create($row);
        }
    }
}

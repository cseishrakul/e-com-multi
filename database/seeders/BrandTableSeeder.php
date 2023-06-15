<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brnadRecords = [
            [
                'id' => 1,
                'name' => 'Arrow',
                'status' => 1
            ],
            [
                'id' => 2,
                'name' => 'Gap',
                'status' => 1
            ],
            [
                'id' => 3,
                'name' => 'Lee',
                'status' => 1
            ],
            [
                'id' => 4,
                'name' => 'Samsung',
                'status' => 1
            ],
        ];

        Brand::insert($brnadRecords);
    }
}

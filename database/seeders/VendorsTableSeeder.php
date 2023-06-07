<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            [
                'id' => 1,
                'name' => 'Efaz',
                'address' => 'BK-10',
                'city' => 'Sylhet',
                'state' => 'Sylhet',
                'country' => 'Bangladesh',
                'pincode' => '3100',
                'mobile' => '01740308899',
                'email' => 'e@gmail.com',
                'status' => 0
            ],
        ];

        Vendor::insert($vendorRecords);
    }
}

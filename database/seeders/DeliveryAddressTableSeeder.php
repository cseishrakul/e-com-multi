<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            [
                'id' => 1, 'user_id' => 1, 'name' => 'Efaz', 'address' => 'Sylhet', 'city' => 'Sylhet', 'state' => 'Sylhet', 'country' => 'Bangladesh' , 'pincode' => '3100', 'mobile' => '01740308899', 'status' => 1
            ],
            [
                'id' => 2, 'user_id' => 1, 'name' => 'Ishrak', 'address' => 'Sylhet', 'city' => 'Sylhet', 'state' => 'Sylhet', 'country' => 'Bangladesh' , 'pincode' => '3100', 'mobile' => '01740309988','status' => 1
            ],
        ];

        DeliveryAddress::insert($deliveryRecords);
    }
}

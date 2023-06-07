<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businessRecord = [
            [
                'id' => 1,
                'vendor_id' => 1,
                'shop_name' => 'Efaz Electronic Shop',
                'shop_address' => 'Bk-10/78',
                'shop_city' => 'Sylhet',
                'shop_state' => 'Sylhet',
                'shop_country' => 'Bangladesh',
                'shop_pincode' => '110050',
                'shop_mobile' => '01740308899',
                'shop_website' => 'sitee.kom',
                'shop_email' => 'e@gmail.com',
                'address_proof' => 'Passport',
                'address_proof_image' => 'test.jpg',
                'business_license_number' => '12434534',
                'gst_number' => '1231313',
                'pan_number' => '1231313',
            ],
        ];

        VendorsBusinessDetail::insert($businessRecord);
    }
}

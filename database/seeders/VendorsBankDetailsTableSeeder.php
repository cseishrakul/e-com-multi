<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankDetail = [
            [
                'id' => 1,
                'vendor_id' => 1,
                'account_holder_name' => 'Efaz',
                'bank_name' => 'ific',
                'account_number' => '1232313',
                'bank_ifsc_code' => '343434',
            ],
        ];

        VendorsBankDetail::insert($bankDetail);
    }
}

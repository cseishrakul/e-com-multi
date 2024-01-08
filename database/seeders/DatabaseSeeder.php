<?php

namespace Database\Seeders;

use App\Models\ProductsAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(AdminTableSeeder::class);
        // $this->call(VendorsTableSeeder::class);
        // $this->call(VendorsBusinessDetailsTableSeeder::class);
        // $this->call(VendorsBankDetailsTableSeeder::class);
        // $this->call(SectionTableSeeder::class);
        // $this->call(CmsPagesTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(BrandTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(ProductsAttributeTableSeeder::class);
        // $this->call(BannerTableSeeder::class);
        // $this->call(FiltersTableSeeder::class);
        // $this->call(FiltersValuesTableSeeder::class);
        // $this->call(CouponsTableSeeder::class);
        $this->call(DeliveryAddressTableSeeder::class);
    }
}

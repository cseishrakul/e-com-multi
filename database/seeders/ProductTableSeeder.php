<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                'id' => 1, 'section_id' => 2, 'category_id' => 12, 'brand_id' => 4, 'vendor_id' => 1,'admin_id' =>0, 'admin_type' => 'vendor', 'product_name' => 'Redmi Note 11', 'product_code' => 'RN11', 'product_color' => 'Blue', 'product_price' => 15000, 'product_discount' => 10, 'product_weight' => 500, 'product_image' => '', 'product_video' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'Yes', 'status' => 1, 'description' => ''
            ],
            [
                'id' => 2, 'section_id' => 2, 'category_id' => 12, 'brand_id' => 4, 'vendor_id' => 0,'admin_id' =>1, 'admin_type' => 'vendor', 'product_name' => 'IPhone 13', 'product_code' => 'RN11', 'product_color' => 'Blue', 'product_price' => 15000, 'prodcut_discount' => 10, 'product_weight' => 500, 'product_image' => '', 'product_video' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'Yes', 'status' => 1, 'description' => ''
            ],
        ];

        Product::insert($productRecords);
    }
}

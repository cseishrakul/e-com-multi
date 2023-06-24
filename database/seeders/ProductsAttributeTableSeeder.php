<?php

namespace Database\Seeders;

use App\Models\ProductsAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecord = [
            [
                'id' => 1, 'product_id' =>1, 'size' => 'Small', 'price' => 100, 'stock' => 10, 'sku' => 'p13-S','status' => 1
            ],
            [
                'id' => 2, 'product_id' =>1, 'size' => 'Medium', 'price' => 150, 'stock' => 5, 'sku' => 'p13-M','status' => 1
            ],
            [
                'id' => 3, 'product_id' =>1, 'size' => 'Large', 'price' => 200, 'stock' => 20, 'sku' => 'p13-L','status' => 1
            ],
        ];

        ProductsAttribute::insert($productAttributesRecord);
    }
}

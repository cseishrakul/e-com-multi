<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecord = [
            [
                'id' => 3,
                'image' => 'banner-2.png',
                'link' => 'tops',
                'title' => 'Tops',
                'alt' => 'Tops',
                'status' => 1
            ]
        ];

        Banner::insert($bannerRecord);
    }
}

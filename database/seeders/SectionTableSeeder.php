<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecord = [
            ['id' => 4, 'name' => 'Electronics', 'status' => 1],
            ['id' => 5, 'name' => 'Appliances', 'status' => 1],
        ];

        Section::insert($sectionRecord);
    }
}

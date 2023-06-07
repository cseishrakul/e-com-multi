<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecord = [
            'name' => 'Efaz',
            'type' => 'vendor',
            'vendor_id' => 1,
            'mobile' => '01740308899',
            'email' => 'e@gmail.comm',
            'password' => '$2a$12$ykuldkDjj4bxYdtdiCGHkOLh9apI6lq0s99EEJTiVecHqdyj1M73q',
            'image' => '',
            'status' => 0,
        ];

        Admin::insert($adminRecord);
    }
}

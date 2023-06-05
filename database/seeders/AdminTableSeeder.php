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
            'name' => 'Super Admin',
            'type' => 'superadmin',
            'vendor_id' => 0,
            'mobile' => '01740308899',
            'email' => 'admin@admin.com',
            'password' => '$2a$12$ykuldkDjj4bxYdtdiCGHkOLh9apI6lq0s99EEJTiVecHqdyj1M73q',
            'image' => '',
            'status' => 1,
        ];

        Admin::insert($adminRecord);
    }
}

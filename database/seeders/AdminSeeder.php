<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'Admin',
                'name' => 'Admin',
                'email' => 'Admin@gmail.com',
                'phone_number' => '06756431427',
                'role' => 'Admin',
                'password' => Hash::make('Admin@123'),
            ],
        ]);
    }
}

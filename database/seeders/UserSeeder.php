<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // atmin bodong le
        User::create([
            'name' => 'Admin Komisin',
            'email' => 'admin@komisin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // yang beli
        User::create([
            'name' => 'Customer Satu',
            'email' => 'customer1@komisin.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // yang beli satu lagi
        User::create([
            'name' => 'Customer Dua',
            'email' => 'customer2@komisin.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);
    }
}

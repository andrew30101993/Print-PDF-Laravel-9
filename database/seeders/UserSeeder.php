<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin 001',
            'email' => 'admin@yopmail.com',
            'password' => Hash::make("123456"),
            'role' => 'admin'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin 002',
            'email' => 'admin_002@yopmail.com',
            'password' => Hash::make("123456"),
            'role' => 'admin'
        ]);
    }
}

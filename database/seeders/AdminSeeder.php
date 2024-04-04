<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'name' => 'Srijana Sharma',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role' => 'Admin',
            'email_verified_at' => now()
        ]);

        User::query()->create([
            'name' => 'User singh',
            'email' => 'user@gmail.com',
            'password' => '12345678',
            'role' => 'User',
            'email_verified_at' => now()
        ]);
    }
}

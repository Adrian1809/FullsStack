<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // Usuario regular
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Usuario Regular',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'email_verified_at' => now(),
                ],
                [
                    'name' => 'User',
                    'email' => 'user@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'email_verified_at' => now(),
                ],
                [
                    'name' => 'Rizqi',
                    'email' => 'semuamana@gmail.com',
                    'password' => Hash::make('1'),
                    'role' => 'user',
                    'email_verified_at' => now(),
                ],
            ]
        );
    }
}

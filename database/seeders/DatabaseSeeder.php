<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bookstore.test'],
            [
                'name' => 'Bookstore Administrator',
                'username' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );

        $this->call(BookSeeder::class);
    }
}
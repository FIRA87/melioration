<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Fira',
            'username' => 'Олимов Фируз',
            'email' => 'olimov.88@inbox.ru',
            'password' => Hash::make('password'),
            'photo' => '2025-11-032025-04-04admin.png',
            'phone' => '900000000',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}

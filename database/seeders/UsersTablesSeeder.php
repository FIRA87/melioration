<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'FIRA',
                'email' => 'olimov.88@inbox.ru',
                'password' => Hash::make('123456789'),
                'roles' => 'admin',
                'status' => 'active',

            ],

            [
                'name' => 'User',
                'username' => 'User UserName',
                'email' => 'user@mail.ru',
                'password' => Hash::make('123456789'),
                'roles' => 'user',
                'status' => 'active',

            ],
        ]);

    }
}

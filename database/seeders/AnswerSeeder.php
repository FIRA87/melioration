<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('answers')->insert([
            'id' => 2,
            'question_id' => 2,
            'option_id' => 4,
            'user_ip' => '127.0.0.1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

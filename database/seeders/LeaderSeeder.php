<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('leaders')->insert([
            'id' => 2,
            'image' => 'upload/leaders/05-11-2025-09-12-04_apple.png',
            'title_ru' => 'Title RU',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'position_ru' => 'Должность [RU]',
            'position_tj' => 'Должность [TJ]',
            'position_en' => 'Должность [EN]',
            'text_ru' => 'Текст RU',
            'text_tj' => 'Текст TJ',
            'text_en' => 'Текст EN',
            'email' => 'olimov.88@inbox.ru',
            'phone' => '67587697809809',
            'working_days' => 'ПН-ПТ, 09:00 - 17:00',
            'slug' => 'title-en',
            'views' => 0,
            'status' => 1,
            'sort' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

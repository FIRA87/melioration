<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tasks')->insert([
            'id' => 5,
            'title_ru' => 'Новости',
            'title_tj' => 'Ахбор',
            'title_en' => 'News',
            'slug' => 'news',
            'text_ru' => 'Текст RU',
            'text_tj' => 'Текст TJ',
            'text_en' => null,
            'views' => 0,
            'status' => 1,
            'sort' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

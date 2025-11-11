<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pages')->insert([
            'id' => 1,
            'title_ru' => 'Title RU',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'url' => 'title-en',
            'text_ru' => 'ТЕКСТ RU',
            'text_tj' => 'ТЕКСТ TJ',
            'text_en' => 'ТЕКСТ EN',
            'status' => 1,
            'sort' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

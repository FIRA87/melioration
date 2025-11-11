<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubPageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sub_pages')->insert([
            'id' => 1,
            'page_id' => 1,
            'title_ru' => 'Подменю RU',
            'title_tj' => 'Подменю TJ',
            'title_en' => 'Подменю EN',
            'url' => 'Подменю-en',
            'text_ru' => 'ТЕКСТ RU',
            'text_tj' => 'ТЕКСТ TJ',
            'text_en' => 'ТЕКСТ EN',
            'status' => 1,
            'sort' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

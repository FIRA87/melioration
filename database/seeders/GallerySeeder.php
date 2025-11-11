<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('galleries')->insert([
            'id' => 3,
            'title_ru' => 'Title RU',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'text_ru' => 'ТЕКСТ [RU]',
            'text_tj' => 'ТЕКСТ [TJ]',
            'text_en' => 'ТЕКСТ [EN]',
            'cover' => '1762242042_8_1sasa11.jpg',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresidentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('presidents')->insert([
            'id' => 2,
            'title_ru' => 'Title RU',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'slug' => 'title-en',
            'image' => 'upload/presidents/20251103_103729_prezident.jpg',
            'text_ru' => '<p>ru</p>',
            'text_tj' => '<p>tj</p>',
            'text_en' => '<p>en</p>',
            'views' => 0,
            'status' => 1,
            'sort' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

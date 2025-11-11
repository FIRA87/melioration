<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->insert([
            'id' => 1,
            'title_ru' => 'Title RU',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'slug' => 'title-en',
            'icon' => '<i class="fas fa-users"></i>',
            'text_ru' => 'Текст RU',
            'text_tj' => 'Текст TJ',
            'text_en' => '<p>Текст EN</p>',
            'views' => 0,
            'status' => 1,
            'sort' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

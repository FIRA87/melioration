<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news')->insert([
            'id' => 7,
            'category_id' => 1,
            'user_id' => 1,
            'title_ru' => 'Title RU',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'slug' => 'title-en',
            'image' => 'upload/news/2025-11-04_1762258501_airbnb.png',
            'news_details_ru' => 'Текст RU',
            'news_details_tj' => 'Текст TJ',
            'news_details_en' => 'Текст EN',
            'top_slider' => 0,
            'publish_date' => '2025-11-04',
            'status' => 1,
            'home_page' => 1,
            'views' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

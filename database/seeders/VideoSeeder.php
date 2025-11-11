<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('videos')->insert([
            'id' => 3,
            'video_url' => 'https://vimeo.com/example2',
            'caption' => 'upload/video/2025-11-0320_2.jpg',
            'title_ru' => 'Title RU',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'status' => 1,
            'position' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

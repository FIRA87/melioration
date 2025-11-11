<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            'id' => 4,
            'title_ru' => 'Title RU',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'slug' => 'title-en',
            'image' => 'upload/projects/20251110_133833_lc24rg50fqwxxl-is13252-samsung-original-imafn3p4trqthqvq.jpeg',
            'start_date' => '2025-10-31',
            'end_date' => '2025-11-30',
            'gallery' => json_encode(['upload/projects/gallery/20251110_133704_6911a43068643_p4.jpg']),
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

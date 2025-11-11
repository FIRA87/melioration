<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            [
                'id' => 10,
                'news_id' => 7,
                'image' => 'upload/news/gallery/20251104_171501_6909ee4554e45.png',
                'sort' => 0,
            ],
            [
                'id' => 11,
                'news_id' => 7,
                'image' => 'upload/news/gallery/20251104_171501_6909ee456311a.png',
                'sort' => 1,
            ],
            [
                'id' => 12,
                'news_id' => 7,
                'image' => 'upload/news/gallery/20251104_171501_6909ee4572b9d.png',
                'sort' => 2,
            ],
            [
                'id' => 13,
                'news_id' => 7,
                'image' => 'upload/news/gallery/20251104_171501_6909ee458886c.png',
                'sort' => 3,
            ],
        ];

        foreach ($images as $image) {
            DB::table('news_images')->insert(array_merge($image, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}

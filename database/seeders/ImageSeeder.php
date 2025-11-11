<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            ['id' => 6, 'image' => '1762242042_img-1.jpg', 'gallery_id' => 3],
            ['id' => 7, 'image' => '1762242042_img-2.jpg', 'gallery_id' => 3],
            ['id' => 8, 'image' => '1762242042_img-7.jpg', 'gallery_id' => 3],
        ];

        foreach ($images as $image) {
            DB::table('images')->insert(array_merge($image, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}

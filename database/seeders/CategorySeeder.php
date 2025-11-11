<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            'id' => 1,
            'title_ru' => 'Новости',
            'title_en' => 'News',
            'title_tj' => 'Ахбор',
            'category_slug' => 'news',
            'status' => 1,
            'position' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

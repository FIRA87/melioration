<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('links')->insert([
            'id' => 2,
            'title_ru' => 'Президент Республики Таджикистан',
            'title_tj' => 'Президенти Ҷумҳурии Тоҷикистон',
            'title_en' => 'President of the Republic of Tajikistan',
            'img' => 'upload/links/2025-11-01Backend2024-08-13.gerb.png',
            'url' => 'https://www.president.tj/',
            'status' => 1,
            'sort' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

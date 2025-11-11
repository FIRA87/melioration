<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('surveys')->insert([
            'id' => 4,
            'title_ru' => 'GIT',
            'title_tj' => 'Title TJ',
            'title_en' => 'Title EN',
            'start_date' => null,
            'end_date' => null,
            'description_ru' => 'Можно использовать git reset, вот так:',
            'description_tj' => 'Описание TJ',
            'description_en' => 'Описание EN',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

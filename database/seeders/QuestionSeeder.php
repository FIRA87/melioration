<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('questions')->insert([
            'id' => 2,
            'survey_id' => 4,
            'text_ru' => 'Как исправить ошибку в комментарии к коммиту?',
            'text_tj' => '',
            'text_en' => '',
            'type' => 'radio',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

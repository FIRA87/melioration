<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        $options = [
            [
                'id' => 4,
                'question_id' => 2,
                'text_ru' => 'git commit —amend',
                'text_tj' => '',
                'text_en' => '',
            ],
            [
                'id' => 5,
                'question_id' => 2,
                'text_ru' => 'git commit push',
                'text_tj' => '',
                'text_en' => '',
            ],
            [
                'id' => 6,
                'question_id' => 2,
                'text_ru' => 'git status',
                'text_tj' => '',
                'text_en' => '',
            ],
        ];

        foreach ($options as $option) {
            DB::table('options')->insert(array_merge($option, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}

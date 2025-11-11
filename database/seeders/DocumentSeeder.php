<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('documents')->insert([
            'id' => 1,
            'title_tj' => 'Title TJ1',
            'title_ru' => 'Title RU1',
            'title_en' => 'Title EN1',
            'description_tj' => 'tj1',
            'description_ru' => 'ru1',
            'description_en' => 'en1',
            'file_path' => 'upload/documents/20251111_094041_invoice.pdf',
            'file_type' => 'pdf',
            'published_at' => '2025-10-31',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

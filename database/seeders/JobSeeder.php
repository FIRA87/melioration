<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jobs')->insert([
            'id' => 4,
            'title_ru' => 'Кассир',
            'title_tj' => 'Хазинадор',
            'title_en' => 'Cashier',
            'slug' => 'cashier',
            'image' => 'upload/jobs/20251110_173201_kassir.jpeg',
            'description_ru' => 'ru',
            'description_tj' => 'tj',
            'description_en' => 'en',
            'requirements_ru' => null,
            'requirements_tj' => null,
            'requirements_en' => null,
            'location' => 'г.Душанбе',
            'salary' => '0',
            'start_date' => '2025-11-06',
            'end_date' => '2025-12-03',
            'attachments' => json_encode(['upload/jobs/attachments/20251111_084740_6912b1dc2cedf_grammar-practice-7.pdf']),
            'is_active' => 1,
            'sort' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

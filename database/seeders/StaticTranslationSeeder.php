<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaticTranslation;

class StaticTranslationSeeder extends Seeder
{
    public function run()
    {
        $translations = [
            [
                'key' => 'show_all_responsibilities',
                'value_ru' => 'Показать все обязанности',
                'value_en' => 'Show All Responsibilities',
                'value_tj' => 'Ҳамаи вазифаҳоро нишон диҳед',
                'group' => 'buttons',
                'description' => 'Кнопка для показа всех обязанностей'
            ],
            [
                'key' => 'read_more',
                'value_ru' => 'Узнать больше',
                'value_en' => 'Read more',
                'value_tj' => 'Дигар...',
                'group' => 'buttons',
                'description' => 'Кнопка "Читать далее"'
            ],
            [
                'key' => 'learn_more',
                'value_ru' => 'Узнать больше',
                'value_en' => 'Learn more',
                'value_tj' => 'Маълумоти бештар',
                'group' => 'buttons',
                'description' => 'Кнопка "Узнать больше"'
            ],
            [
                'key' => 'contact_us',
                'value_ru' => 'Свяжитесь с нами',
                'value_en' => 'Contact us',
                'value_tj' => 'Бо мо тамос гиред',
                'group' => 'buttons',
                'description' => 'Кнопка контактов'
            ],
            [
                'key' => 'our_services',
                'value_ru' => 'Наши услуги',
                'value_en' => 'Our Services',
                'value_tj' => 'Хизматҳои мо',
                'group' => 'titles',
                'description' => 'Заголовок секции услуг'
            ],
            // Добавьте свои переводы здесь
        ];

        foreach ($translations as $translation) {
            StaticTranslation::updateOrCreate(
                ['key' => $translation['key']],
                $translation
            );
        }
    }
}
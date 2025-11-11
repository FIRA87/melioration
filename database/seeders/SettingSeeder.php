<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            'id' => 1,
            'street_ru' => 'ул. Хабиб Ахрори 140/1, 2 этаж 734001 Душанбе, Таджикистан',
            'street_tj' => 'ул. Хабиб Ахрори 140/1, 2 этаж 734001 Душанбе, Таджикистан',
            'street_en' => 'ul. Habib Akhrori 140/1, 2nd floor 734001 Dushanbe, Tajikistan',
            'phone' => '+992907400055',
            'email' => 'user@user.com',
            'logo' => 'upload/logo/logo_1762241967.jpg',
            'facebook' => 'https://www.facebook.com/',
            'twitter' => 'https://twitter.com/',
            'telegram' => 'https://telegram.org/',
            'instagram' => 'https://www.instagram.com/',
            'youtube' => 'https://youtube.com/',
            'contact_title' => 'Контакт',
            'contact_detail' => '+992 37 227 38 38',
            'contact_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2301.382669419986!2d32.02417099376721!3d54.77323999672319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46ce580520d36a2d%3A0x9e70622a8865bd84!2z0KPQv9GA0LDQstC70LXQvdC40LUg0JzQtdC70LjQvtGA0LDRhtC40Lgg0JfQtdC80LXQu9GMINCYINCh0LXQu9GM0YHQutC-0YXQvtC30Y_QudGB0YLQstC10L3QvdC-0LPQviDQktC-0LTQvtGB0L3QsNCx0LbQtdC90LjRjw!5e0!3m2!1sru!2s!4v1762241795793!5m2!1sru!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

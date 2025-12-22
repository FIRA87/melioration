<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaticTranslation extends Model
{

    use HasFactory;


    protected $fillable = [
        'key',
        'value_ru',
        'value_en',
        'value_tj',
        'group',
        'description'
    ];

    /**
     * Получить перевод по ключу
     */
    public static function trans($key, $lang = null)
    {
        if (!$lang) {
            $lang = session()->get('lang', 'ru');
        }

        $translation = static::where('key', $key)->first();

        if (!$translation) {
            return $key; // возвращаем ключ, если перевод не найден
        }

        $field = 'value_' . $lang;
        return $translation->$field ?? $translation->value_ru;
    }

    /**
     * Получить все переводы определенной группы
     */
    public static function getGroup($group, $lang = null)
    {
        if (!$lang) {
            $lang = session()->get('lang', 'ru');
        }

        $translations = static::where('group', $group)->get();
        $result = [];

        foreach ($translations as $translation) {
            $field = 'value_' . $lang;
            $result[$translation->key] = $translation->$field ?? $translation->value_ru;
        }

        return $result;
    }
}
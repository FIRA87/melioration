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

    protected static $cache = null;

    /**
     * Автоочистка кеша при изменениях модели
     */
    protected static function booted()
    {
        static::created(function () {
            static::$cache = null;
        });

        static::updated(function () {
            static::$cache = null;
        });

        static::deleted(function () {
            static::$cache = null;
        });
    }

    /**
     * Загрузка всего словаря (1 раз за запрос)
     */
    protected static function loadCache()
    {
        if (static::$cache === null) {
            static::$cache = static::all()->keyBy('key');
        }
    }

    /**
     * Получить перевод по ключу
     */
    public static function trans($key, $lang = null)
    {
        static::loadCache();

        if (!$lang) {
            $lang = session()->get('lang', 'ru');
        }

        $item = static::$cache->get($key);

        if (!$item) {
            return $key;
        }

        $field = 'value_' . $lang;

        return $item->$field ?? $item->value_ru;
    }

    /**
     * Получить группу переводов
     */
    public static function getGroup($group, $lang = null)
    {
        static::loadCache();

        if (!$lang) {
            $lang = session()->get('lang', 'ru');
        }

        return static::$cache
            ->where('group', $group)
            ->map(function ($item) use ($lang) {
                $field = 'value_' . $lang;
                return $item->$field ?? $item->value_ru;
            })
            ->toArray();
    }
}


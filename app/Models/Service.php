<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru',
        'title_tj',
        'title_en',
        'slug',
        'icon',
        'text_ru',
        'text_tj',
        'text_en',
        'views',
        'status',
        'sort',
    ];
}

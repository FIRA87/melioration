<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru', 'title_tj', 'title_en', 'slug', 'image',
        'text_ru', 'text_tj', 'text_en', 'views', 'status', 'sort',
        'start_date', 'end_date', 'gallery'
    ];

    protected $casts = [
        'gallery' => 'array',
    ];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru', 'title_tj', 'title_en', 'slug',
        'image',
        'description_ru', 'description_tj', 'description_en',
        'requirements_ru', 'requirements_tj', 'requirements_en',
        'location', 'salary',
        'start_date', 'end_date',
        'attachments',
        'is_active', 'sort'
    ];

    protected $casts = [
        'attachments' => 'array',
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}

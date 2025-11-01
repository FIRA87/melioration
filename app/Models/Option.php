<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id', 'text_ru', 'text_tj', 'text_en'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

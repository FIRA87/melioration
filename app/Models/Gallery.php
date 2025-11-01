<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru',
        'title_tj',
        'title_en',
        'text_ru',
        'text_tj',
        'text_en',
        'cover',
    ];


    public function images(){
        return $this->hasMany(Image::class);
    }


}

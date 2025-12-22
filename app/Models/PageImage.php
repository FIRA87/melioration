<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'image',
        'sort_order',
    ];

    /**
     * Get the parent imageable model (Page or SubPage).
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SubPage extends Model
{
    use HasFactory;

    protected $guarded = [];


        /**
     * Get all images for this subpage.
     */
    public function images()
    {
        return $this->morphMany(PageImage::class, 'imageable')->orderBy('sort_order');
    }

    

    public function page(){
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function subSubmenus()
    {
        return $this->hasMany(SubSubPage::class, 'sub_page_id');
    }


    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('active_subpages');
        });
        
        static::deleted(function () {
            Cache::forget('active_subpages');
        });
    }




}

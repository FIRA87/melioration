<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

     public function submenus(){
        return $this->hasMany(SubPage::class, 'page_id')->where('status', 1);
    }

    public function subSubmenus()
    {
        return $this->hasMany(SubSubPage::class, 'sub_page_id');
    }


     protected static function booted()
    {
        static::saved(function () {
            Cache::forget('active_pages');
        });
        
        static::deleted(function () {
            Cache::forget('active_pages');
        });
    }


}

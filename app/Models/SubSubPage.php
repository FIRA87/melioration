<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubPage extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function subPage()
    {
        return $this->belongsTo(SubPage::class, 'sub_page_id');
    }



}

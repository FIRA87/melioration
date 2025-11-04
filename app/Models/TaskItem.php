<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
    protected $fillable = [
        'task_id',
        'text_ru',
        'text_tj',
        'text_en',
        'sort',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}

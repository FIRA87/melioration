<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Связь с задачами (многие-ко-многим)
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'news_tasks', 'news_id', 'task_id')->withTimestamps();
    }

    // Связь с дополнительными изображениями
    public function images()
    {
        return $this->hasMany(NewsImage::class);
    }
	
	
	public function scopePublished($query)
	{
		return $query->where('status', 1)
			->where(function($q) {
				$q->whereNull('publish_date')
				  ->orWhere('publish_date', '<=', now());
			});
	}

	public function scopeActive($query)
	{
		return $query->where('status', 1);
	}


}

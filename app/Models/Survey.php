<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

	  protected $fillable = [
			'title_ru', 'title_tj', 'title_en',
			'description_ru', 'description_tj', 'description_en',
			'is_active',
	];

		public function questions()
		{
				return $this->hasMany(Question::class);
		}
}

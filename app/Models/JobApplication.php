<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'cover_letter',
        'resume',
        'additional_files',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'additional_files' => 'array',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
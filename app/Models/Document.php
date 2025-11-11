<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title_tj',
        'title_ru',
        'title_en',
        'description_tj',
        'description_ru',
        'description_en',
        'file_path',
        'file_type',
        'published_at',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'date',
    ];

    public function getIcon(): string
    {
        $type = strtolower($this->file_type ?? pathinfo($this->file_path, PATHINFO_EXTENSION));

        return match ($type) {
            'pdf'   => asset('icons/pdf.png'),
            'doc', 'docx' => asset('icons/word.png'),
            'xls', 'xlsx' => asset('icons/excel.png'),
            default => asset('icons/file.png'),
        };
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'news_details_ru' => 'nullable|string',
            'news_details_tj' => 'nullable|string',
            'news_details_en' => 'nullable|string',
            'publish_date' => 'date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'tasks' => 'nullable|array',
            'tasks.*' => 'exists:tasks,id',
            'top_slider' => 'nullable|in:0,1',
            'home_page' => 'nullable|in:0,1',
            'status' => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title_ru.required' => 'Введите заголовок на русском языке.',
            'title_en.required' => 'Введите заголовок на английском языке.',
            'category_id.required' => 'Выберите категорию.',
            'publish_date.required' => 'Укажите дату публикации.',
            'image.image' => 'Файл должен быть изображением.',
            'gallery.*.image' => 'Все файлы галереи должны быть изображениями.',
        ];
    }
}

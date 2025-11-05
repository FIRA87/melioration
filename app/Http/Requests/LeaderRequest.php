<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'required|nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'position_ru' => 'required|string|max:255',
            'position_tj' => 'nullable|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'working_days' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'text_ru' => 'nullable|string',
            'text_tj' => 'nullable|string',
            'text_en' => 'nullable|string',
            'sort' => 'nullable|integer|min:0',
            'status' => 'nullable|in:0,1',

        ];
    }

    public function messages(): array
    {
        return [
            'title_ru.required' => 'Введите заголовок на русском языке.',
            'image.image' => 'Файл должен быть изображением.',

        ];
    }
}

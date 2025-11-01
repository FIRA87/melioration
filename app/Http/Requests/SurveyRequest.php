<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
{
    /**
     * Определяет, авторизован ли пользователь для выполнения этого запроса.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации для полей опроса.
     * Работает как для создания, так и для обновления опроса.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ru' => 'nullable|string',
            'description_tj' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Кастомные сообщения об ошибках валидации на русском языке.
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title_ru.required' => 'Введите название опроса на русском языке.',
            'title_ru.string' => 'Название опроса на русском должно быть строкой.',
            'title_ru.max' => 'Название опроса на русском не должно превышать 255 символов.',
            'title_tj.required' => 'Введите название опроса на таджикском языке.',
            'title_tj.string' => 'Название опроса на таджикском должно быть строкой.',
            'title_tj.max' => 'Название опроса на таджикском не должно превышать 255 символов.',
            'title_en.required' => 'Введите название опроса на английском языке.',
            'title_en.string' => 'Название опроса на английском должно быть строкой.',
            'title_en.max' => 'Название опроса на английском не должно превышать 255 символов.',
            'description_ru.string' => 'Описание опроса на русском должно быть строкой.',
            'description_tj.string' => 'Описание опроса на таджикском должно быть строкой.',
            'description_en.string' => 'Описание опроса на английском должно быть строкой.',
            'is_active.boolean' => 'Статус активности должен быть булевым значением.',
        ];
    }
}


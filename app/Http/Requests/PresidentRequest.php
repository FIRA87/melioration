<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresidentRequest extends FormRequest
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
     * Правила валидации для полей президента.
     * Работает как для создания, так и для обновления.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $presidentId = $this->id ?? null;

        return [
            'id' => 'required|exists:presidents,id',
            'title_tj' => 'required|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:presidents,slug,' . $presidentId,
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'text_tj' => 'required|string',
            'text_ru' => 'nullable|string',
            'text_en' => 'nullable|string',
            'sort' => 'nullable|integer|min:0',
            'status' => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title_tj.required' => 'Введите название на таджикском языке.',
            'text_tj.required' => 'Введите текст на таджикском.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Изображение должно быть jpeg, jpg, png, gif.',
            'slug.unique' => 'Такой URL уже существует.',
        ];
    }

}


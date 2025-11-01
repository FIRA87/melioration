<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
     * Правила валидации для полей ссылки.
     * Работает как для создания, так и для обновления ссылки.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $linkId = $this->id ?? null;

        return [
            'id' => 'sometimes|exists:links,id',
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'img' => $this->isMethod('post') ? 'required|image|mimes:jpeg,jpg,png,gif|max:2048' : 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'status' => 'required|in:0,1,Active,Inactive',
            'position' => 'nullable|integer|min:0',
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
            'id.exists' => 'Ссылка не найдена.',
            'title_ru.required' => 'Введите название ссылки на русском языке.',
            'title_ru.string' => 'Название ссылки на русском должно быть строкой.',
            'title_ru.max' => 'Название ссылки на русском не должно превышать 255 символов.',
            'title_tj.string' => 'Название ссылки на таджикском должно быть строкой.',
            'title_tj.max' => 'Название ссылки на таджикском не должно превышать 255 символов.',
            'title_en.required' => 'Введите название ссылки на английском языке.',
            'title_en.string' => 'Название ссылки на английском должно быть строкой.',
            'title_en.max' => 'Название ссылки на английском не должно превышать 255 символов.',
            'url.required' => 'Введите URL ссылки.',
            'url.url' => 'URL должен быть корректным адресом.',
            'url.max' => 'URL не должен превышать 500 символов.',
            'img.required' => 'Загрузите изображение для ссылки.',
            'img.image' => 'Изображение должно быть файлом изображения.',
            'img.mimes' => 'Изображение должно быть в формате: jpeg, jpg, png или gif.',
            'img.max' => 'Размер изображения не должен превышать 2 МБ.',
            'status.required' => 'Укажите статус ссылки.',
            'status.in' => 'Статус может быть только: 0, 1, Active или Inactive.',
            'position.integer' => 'Позиция должна быть целым числом.',
            'position.min' => 'Позиция не может быть отрицательной.',
        ];
    }
}


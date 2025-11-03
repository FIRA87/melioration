<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
     * Правила валидации для полей услуги.
     * Работает как для создания, так и для обновления.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'title_ru' => 'nullable|string|max:255',
            'title_tj' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'text_ru' => 'nullable|string',
            'text_tj' => 'required|string',
            'text_en' => 'nullable|string',
            'status' => 'nullable|in:0,1',
            'sort' => 'nullable|integer|min:0',
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
            'id.exists' => 'Услуга не найдена.',
            'title_tj.required' => 'Введите название услуги на таджикском языке.',
            'title_tj.string' => 'Название услуги на таджикском должно быть строкой.',
            'title_tj.max' => 'Название услуги на таджикском не должно превышать 255 символов.',
            'title_ru.string' => 'Название услуги на русском должно быть строкой.',
            'title_ru.max' => 'Название услуги на русском не должно превышать 255 символов.',
            'title_en.string' => 'Название услуги на английском должно быть строкой.',
            'title_en.max' => 'Название услуги на английском не должно превышать 255 символов.',
            'slug.required' => 'Введите URL-адрес услуги (slug).',
            'slug.string' => 'URL-адрес должен быть строкой.',
            'slug.max' => 'URL-адрес не должен превышать 255 символов.',
            'slug.unique' => 'Услуга с таким URL-адресом уже существует.',
            'icon.required' => 'Введите иконку услуги.',
            'icon.string' => 'Иконка должна быть строкой.',
            'icon.max' => 'Иконка не должна превышать 255 символов.',
            'text_tj.required' => 'Введите описание услуги на таджикском языке.',
            'text_tj.string' => 'Описание услуги на таджикском должно быть строкой.',
            'text_ru.string' => 'Описание услуги на русском должно быть строкой.',
            'text_en.string' => 'Описание услуги на английском должно быть строкой.',
            'status.required' => 'Укажите статус услуги.',
            'status.in' => 'Статус может быть только: 0, 1, true или false.',
            'sort.integer' => 'Поле сортировки должно быть целым числом.',
            'sort.min' => 'Поле сортировки не может быть отрицательным.',
        ];
    }
}


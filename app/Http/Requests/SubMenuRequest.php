<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubMenuRequest extends FormRequest
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
     * Правила валидации для полей подменю.
     * Работает как для создания, так и для обновления подменю.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $subMenuId = $this->id ?? null;

        return [
            'id' => 'sometimes|exists:sub_pages,id',
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'text_ru' => 'nullable|string',
            'text_tj' => 'nullable|string',
            'text_en' => 'nullable|string',
            'status' => 'required|in:0,1,Active,Inactive',
            'page_id' => 'required|exists:pages,id',
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
            'id.exists' => 'Подменю не найдено.',
            'title_ru.required' => 'Введите название подменю на русском языке.',
            'title_ru.string' => 'Название подменю на русском должно быть строкой.',
            'title_ru.max' => 'Название подменю на русском не должно превышать 255 символов.',
            'title_tj.string' => 'Название подменю на таджикском должно быть строкой.',
            'title_tj.max' => 'Название подменю на таджикском не должно превышать 255 символов.',
            'title_en.required' => 'Введите название подменю на английском языке.',
            'title_en.string' => 'Название подменю на английском должно быть строкой.',
            'title_en.max' => 'Название подменю на английском не должно превышать 255 символов.',
            'text_ru.string' => 'Текст подменю на русском должен быть строкой.',
            'text_tj.string' => 'Текст подменю на таджикском должен быть строкой.',
            'text_en.string' => 'Текст подменю на английском должен быть строкой.',
            'status.required' => 'Укажите статус подменю.',
            'status.in' => 'Статус может быть только: 0, 1, Active или Inactive.',
            'page_id.required' => 'Выберите родительскую страницу.',
            'page_id.exists' => 'Выбранная страница не существует.',
            'sort.integer' => 'Поле сортировки должно быть целым числом.',
            'sort.min' => 'Поле сортировки не может быть отрицательным.',
        ];
    }
}


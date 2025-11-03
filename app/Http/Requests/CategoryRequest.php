<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * Правила валидации для полей категории.
     * Работает как для создания, так и для обновления категории.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = $this->id ?? null; // сохраняем ID для правила unique при обновлении

        return [
            'id' => 'sometimes|exists:categories,id',
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255|unique:categories,title_en,' . $categoryId,
            'position' => 'nullable|integer|min:0',
            'status' => 'required|in:0,1,true,false',
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
            'id.exists' => 'Категория не найдена.',
            'title_ru.required' => 'Введите название категории на русском языке.',
            'title_ru.string' => 'Название категории на русском должно быть строкой.',
            'title_ru.max' => 'Название категории на русском не должно превышать 255 символов.',
            'title_tj.string' => 'Название категории на таджикском должно быть строкой.',
            'title_tj.max' => 'Название категории на таджикском не должно превышать 255 символов.',
            'title_en.required' => 'Введите название категории на английском языке.',
            'title_en.string' => 'Название категории на английском должно быть строкой.',
            'title_en.max' => 'Название категории на английском не должно превышать 255 символов.',
            'title_en.unique' => 'Категория с таким английским названием уже существует.',
            'position.integer' => 'Позиция должна быть целым числом.',
            'position.min' => 'Позиция не может быть отрицательной.',
            'status.required' => 'Укажите статус категории.',
            'status.in' => 'Статус может быть только: 0, 1, true или false.',
        ];
    }
}


<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pageId = $this->id ?? null; // сохраняем для update

        return [
            'id' => 'sometimes|exists:pages,id',
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255|unique:pages,title_en,' . $pageId,
            'text_ru' => 'nullable|string',
            'text_tj' => 'nullable|string',
            'text_en' => 'nullable|string',
            'status' => 'required|in:0,1',
            'sort' => 'nullable|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Max 5MB per image
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'nullable|integer|exists:page_images,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => 'Страница не найдена.',
            'title_ru.required' => 'Введите название страницы на русском.',
            'title_en.required' => 'Введите название страницы на английском.',
            'title_en.unique' => 'Страница с таким английским названием уже существует.',
            'status.required' => 'Укажите статус (активна/неактивна).',
            'sort.integer' => 'Поле сортировки должно быть числом.',
            'sort.min' => 'Поле сортировки не может быть отрицательным.',
        ];
    }
}

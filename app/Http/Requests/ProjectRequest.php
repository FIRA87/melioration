<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // считаем, что это update, если передан id или если метод PUT/PATCH
        $projectId = $this->input('id') ?? null;
        $isUpdate = $projectId !== null || $this->isMethod('put') || $this->isMethod('patch');

        return [
            'id' => $isUpdate ? 'required|exists:projects,id' : 'nullable',
            'title_tj' => 'required|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,' . ($projectId ?? 'NULL') . ',id',
            // если update -> nullable|image, если create -> required|image
            'image' => $isUpdate ? 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048' : 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'text_tj' => 'required|string',
            'text_ru' => 'nullable|string',
            'text_en' => 'nullable|string',
            'sort' => 'nullable|integer|min:0',
            'status' => 'nullable|in:0,1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'title_tj.required' => 'Введите название на таджикском языке.',
            'text_tj.required' => 'Введите текст на таджикском.',
            'image.required' => 'Загрузите изображение.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Изображение должно быть jpeg, jpg, png, gif или webp.',
            'slug.unique' => 'Такой URL уже существует.',
            'gallery.*.image' => 'Файл в галерее должен быть изображением.',
            'end_date.after_or_equal' => 'Дата окончания должна быть позже или равна дате начала.',
        ];
    }
}

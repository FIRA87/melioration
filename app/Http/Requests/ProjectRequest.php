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
        $projectId = $this->id ?? null;
        $isUpdate = $this->isMethod('post') && $this->has('id');

        return [
            'id' => $isUpdate ? 'required|exists:projects,id' : 'nullable',
            'title_tj' => 'required|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,' . $projectId,
            'image' => $isUpdate ? 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048' : 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
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
            'image.required' => 'Загрузите изображение.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Изображение должно быть jpeg, jpg, png, gif.',
            'slug.unique' => 'Такой URL уже существует.',
        ];
    }
}

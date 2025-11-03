<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $taskId = $this->id ?? null;
        $isUpdate = $this->isMethod('post') && $this->has('id');

        return [
            'id' => $isUpdate ? 'required|exists:tasks,id' : 'nullable',
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tasks,slug,' . $taskId,
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
            'title_ru.required' => 'Введите название на русском языке.',
            'title_tj.required' => 'Введите название на таджикском языке.',
            'title_en.required' => 'Введите название на английском языке.',
            'slug.unique' => 'Такой URL уже существует.',
        ];
    }
}

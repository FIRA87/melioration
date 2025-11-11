<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $jobId = $this->route('job')?->id ?? $this->input('id') ?? null;
        $isUpdate = (bool)$jobId;

        return [
            'title_tj' => 'required|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:jobs,slug,' . ($jobId ?? 'NULL') . ',id',

            'image' => $isUpdate ? 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096' : 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',

            'description_tj' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',

            'requirements_tj' => 'nullable|string',
            'requirements_ru' => 'nullable|string',
            'requirements_en' => 'nullable|string',

            'location' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',

            // attachments: array of files (pdf/images)
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,jpg,jpeg,png,webp|max:5120', // up to 5MB
            'sort' => 'nullable|integer|min:0',
            'is_active' => 'nullable|in:0,1,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title_tj.required' => 'Введите заголовок (Тадж).',
            'end_date.after_or_equal' => 'Дата окончания должна быть позже или равна дате начала.',
            'attachments.*.mimes' => 'Допускаются файлы pdf, jpg, jpeg, png, webp.',
        ];
    }
}

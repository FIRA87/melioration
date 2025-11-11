<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $docId = $this->route('document')?->id ?? null;
        $isUpdate = (bool) $docId;

        return [
            'title_tj' => 'required|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tj' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'file' => $isUpdate
                ? 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240'
                : 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'published_at' => 'nullable|date',
            'is_active' => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title_tj.required' => 'Введите название (Тадж).',
            'file.required' => 'Выберите файл документа.',
            'file.mimes' => 'Допускаются только pdf, doc, docx, xls, xlsx.',
            'file.max' => 'Файл не должен превышать 10 МБ.',
        ];
    }
}

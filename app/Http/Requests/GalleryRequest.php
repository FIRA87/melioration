<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
     * Правила валидации для полей галереи.
     * Работает как для создания, так и для обновления галереи.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $galleryId = $this->route('id') ?? $this->id ?? null;

        return [
            'id' => 'sometimes|exists:galleries,id',
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'text_ru' => 'nullable|string',
            'text_tj' => 'nullable|string',
            'text_en' => 'nullable|string',
            'cover' => $this->isMethod('post') ? 'required|image|mimes:jpeg,jpg,png,gif|max:2048' : 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
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
            'id.exists' => 'Галерея не найдена.',
            'title_ru.required' => 'Введите название галереи на русском языке.',
            'title_ru.string' => 'Название галереи на русском должно быть строкой.',
            'title_ru.max' => 'Название галереи на русском не должно превышать 255 символов.',
            'title_tj.string' => 'Название галереи на таджикском должно быть строкой.',
            'title_tj.max' => 'Название галереи на таджикском не должно превышать 255 символов.',
            'title_en.required' => 'Введите название галереи на английском языке.',
            'title_en.string' => 'Название галереи на английском должно быть строкой.',
            'title_en.max' => 'Название галереи на английском не должно превышать 255 символов.',
            'text_ru.string' => 'Текст галереи на русском должен быть строкой.',
            'text_tj.string' => 'Текст галереи на таджикском должен быть строкой.',
            'text_en.string' => 'Текст галереи на английском должен быть строкой.',
            'cover.required' => 'Загрузите обложку галереи.',
            'cover.image' => 'Обложка должна быть изображением.',
            'cover.mimes' => 'Обложка должна быть в формате: jpeg, jpg, png или gif.',
            'cover.max' => 'Размер обложки не должен превышать 2 МБ.',
            'images.array' => 'Изображения должны быть массивом.',
            'images.*.image' => 'Каждый файл должен быть изображением.',
            'images.*.mimes' => 'Каждое изображение должно быть в формате: jpeg, jpg, png или gif.',
            'images.*.max' => 'Размер каждого изображения не должен превышать 2 МБ.',
        ];
    }
}


<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
     * Правила валидации для полей новости.
     * Работает как для создания, так и для обновления новости.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $newsId = $this->id ?? null;

        return [
            'id' => 'sometimes|exists:news,id',
            'category_id' => 'required|exists:categories,id',
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'news_details_ru' => 'nullable|string',
            'news_details_tj' => 'nullable|string',
            'news_details_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'top_slider' => 'nullable|in:0,1,Yes,No',
            'publish_date' => 'nullable|date',
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
            'id.exists' => 'Новость не найдена.',
            'category_id.required' => 'Выберите категорию новости.',
            'category_id.exists' => 'Выбранная категория не существует.',
            'title_ru.required' => 'Введите заголовок новости на русском языке.',
            'title_ru.string' => 'Заголовок новости на русском должен быть строкой.',
            'title_ru.max' => 'Заголовок новости на русском не должен превышать 255 символов.',
            'title_tj.string' => 'Заголовок новости на таджикском должен быть строкой.',
            'title_tj.max' => 'Заголовок новости на таджикском не должен превышать 255 символов.',
            'title_en.required' => 'Введите заголовок новости на английском языке.',
            'title_en.string' => 'Заголовок новости на английском должен быть строкой.',
            'title_en.max' => 'Заголовок новости на английском не должен превышать 255 символов.',
            'news_details_ru.string' => 'Содержание новости на русском должно быть строкой.',
            'news_details_tj.string' => 'Содержание новости на таджикском должно быть строкой.',
            'news_details_en.string' => 'Содержание новости на английском должно быть строкой.',
            'image.image' => 'Изображение должно быть файлом изображения.',
            'image.mimes' => 'Изображение должно быть в формате: jpeg, jpg, png или gif.',
            'image.max' => 'Размер изображения не должен превышать 2 МБ.',
            'top_slider.in' => 'Параметр top_slider может быть только: 0, 1, Yes или No.',
            'publish_date.date' => 'Дата публикации должна быть корректной датой.',
        ];
    }
}


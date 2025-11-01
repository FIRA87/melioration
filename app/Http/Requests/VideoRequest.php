<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
     * Правила валидации для полей видео.
     * Работает как для создания, так и для обновления видео.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $videoId = $this->id ?? null;

        return [
            'id' => 'sometimes|exists:videos,id',
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'video_url' => 'required|url|max:500',
            'caption' => $this->isMethod('post') ? 'required|image|mimes:jpeg,jpg,png,gif|max:2048' : 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'status' => 'required|in:0,1,Active,Inactive',
            'position' => 'nullable|integer|min:0',
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
            'id.exists' => 'Видео не найдено.',
            'title_ru.required' => 'Введите название видео на русском языке.',
            'title_ru.string' => 'Название видео на русском должно быть строкой.',
            'title_ru.max' => 'Название видео на русском не должно превышать 255 символов.',
            'title_tj.string' => 'Название видео на таджикском должно быть строкой.',
            'title_tj.max' => 'Название видео на таджикском не должно превышать 255 символов.',
            'title_en.required' => 'Введите название видео на английском языке.',
            'title_en.string' => 'Название видео на английском должно быть строкой.',
            'title_en.max' => 'Название видео на английском не должно превышать 255 символов.',
            'video_url.required' => 'Введите URL видео.',
            'video_url.url' => 'URL видео должен быть корректным адресом.',
            'video_url.max' => 'URL видео не должен превышать 500 символов.',
            'caption.required' => 'Загрузите обложку для видео.',
            'caption.image' => 'Обложка должна быть изображением.',
            'caption.mimes' => 'Обложка должна быть в формате: jpeg, jpg, png или gif.',
            'caption.max' => 'Размер обложки не должен превышать 2 МБ.',
            'status.required' => 'Укажите статус видео.',
            'status.in' => 'Статус может быть только: 0, 1, Active или Inactive.',
            'position.integer' => 'Позиция должна быть целым числом.',
            'position.min' => 'Позиция не может быть отрицательной.',
        ];
    }
}


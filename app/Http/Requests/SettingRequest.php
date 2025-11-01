<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * Правила валидации для полей настроек.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'sometimes|exists:settings,id',
            'street_ru' => 'nullable|string|max:255',
            'street_tj' => 'nullable|string|max:255',
            'street_en' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:500',
            'twitter' => 'nullable|url|max:500',
            'telegram' => 'nullable|url|max:500',
            'instagram' => 'nullable|url|max:500',
            'youtube' => 'nullable|url|max:500',
            'contact_title' => 'required|string|max:255',
            'contact_detail' => 'nullable|string',
            'contact_map' => 'nullable|string',
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
            'id.exists' => 'Настройка не найдена.',
            'street_ru.string' => 'Адрес на русском должен быть строкой.',
            'street_ru.max' => 'Адрес на русском не должен превышать 255 символов.',
            'street_tj.string' => 'Адрес на таджикском должен быть строкой.',
            'street_tj.max' => 'Адрес на таджикском не должен превышать 255 символов.',
            'street_en.string' => 'Адрес на английском должен быть строкой.',
            'street_en.max' => 'Адрес на английском не должен превышать 255 символов.',
            'phone.string' => 'Телефон должен быть строкой.',
            'phone.max' => 'Телефон не должен превышать 50 символов.',
            'email.email' => 'Email должен быть корректным адресом электронной почты.',
            'email.max' => 'Email не должен превышать 255 символов.',
            'facebook.url' => 'Facebook должен быть корректным URL.',
            'facebook.max' => 'URL Facebook не должен превышать 500 символов.',
            'twitter.url' => 'Twitter должен быть корректным URL.',
            'twitter.max' => 'URL Twitter не должен превышать 500 символов.',
            'telegram.url' => 'Telegram должен быть корректным URL.',
            'telegram.max' => 'URL Telegram не должен превышать 500 символов.',
            'instagram.url' => 'Instagram должен быть корректным URL.',
            'instagram.max' => 'URL Instagram не должен превышать 500 символов.',
            'youtube.url' => 'YouTube должен быть корректным URL.',
            'youtube.max' => 'URL YouTube не должен превышать 500 символов.',
            'contact_title.required' => 'Введите заголовок контакта.',
            'contact_title.string' => 'Заголовок контакта должен быть строкой.',
            'contact_title.max' => 'Заголовок контакта не должен превышать 255 символов.',
            'contact_detail.string' => 'Детали контакта должны быть строкой.',
            'contact_map.string' => 'Карта должна быть строкой.',
        ];
    }
}


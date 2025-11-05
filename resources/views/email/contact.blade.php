@component('mail::message')
    # Новое сообщение с сайта

    **Имя:** {{ $contact->title_ru }}
    **Email:** {{ $contact->email ?? '-' }}
    **Телефон:** {{ $contact->phone ?? '-' }}

    **Сообщение:**
    {{ $contact->message_ru }}

@endcomponent

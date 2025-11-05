@extends('admin.admin_dashboard')
@section('admin')
    <div class="container">
        <h4>Сообщение №{{ $contact->id }}</h4>
        <p><strong>Имя:</strong> {{ $contact->title_ru }}</p>
        <p><strong>Email:</strong> {{ $contact->email ?? '-' }}</p>
        <p><strong>Телефон:</strong> {{ $contact->phone ?? '-' }}</p>
        <p><strong>Сообщение:</strong></p>
        <div class="border p-3 bg-light">{{ $contact->message_ru }}</div>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary mt-3">Назад</a>
    </div>
@endsection

@extends('admin.admin_dashboard')
@section('admin')

@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 


<div class="container">
    <h4>Сообщение №{{ $contact->id }}</h4>
    <p><strong>Имя:</strong> {{ $contact->title_ru }}</p>
    <p><strong>Email:</strong> {{ $contact->email ?? '-' }}</p>
    <p><strong>Телефон:</strong> {{ $contact->phone ?? '-' }}</p>
    <p><strong>Сообщение:</strong></p>
    <div class="border p-3 bg-light">{{ $contact->message_ru }}</div>
    <a href="{{ route('contacts.index') }}" class="btn btn-secondary mt-3">Назад</a>
</div>

@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif
@endsection

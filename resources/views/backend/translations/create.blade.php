@extends('admin.admin_dashboard')
@section('admin')

@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 
<div class="card">
    <div class="card-header">
        <h4>Добавить новый перевод</h4>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger m-3">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card-body">
        <form action="{{ route('static-translations.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Ключ (уникальный идентификатор)*</label>
                <input type="text" name="key" class="form-control" value="{{ old('key') }}" required placeholder="show_all_responsibilities">
                <small class="text-muted">Используйте snake_case. Пример: show_all_responsibilities, read_more, learn_more</small>
            </div>

            <div class="mb-3">
                <label>Группа (для организации)</label>
                <input type="text" name="group" class="form-control" value="{{ old('group') }}" placeholder="buttons">
                <small class="text-muted">Например: buttons, titles, messages, forms</small>
            </div>

            <div class="mb-3">
                <label>Описание (для чего используется)</label>
                <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                <small class="text-muted">Где используется этот перевод на сайте</small>
            </div>

            <hr>

            <div class="mb-3">
                <label>Текст на русском*</label>
                <textarea name="value_ru" class="form-control" rows="3" required>{{ old('value_ru') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Текст на английском*</label>
                <textarea name="value_en" class="form-control" rows="3" required>{{ old('value_en') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Текст на таджикском*</label>
                <textarea name="value_tj" class="form-control" rows="3" required>{{ old('value_tj') }}</textarea>
            </div>

            <button class="btn btn-primary">Добавить</button>
            <a href="{{ route('static-translations.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</div>



@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif



@endsection
@extends('admin.admin_dashboard')
@section('admin')
    <div class="container py-4">
        <h3>Добавить документ</h3>

        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                {{-- Названия --}}
                <div class="col-md-4">
                    <label>Название TJ *</label>
                    <input name="title_tj" class="form-control" value="{{ old('title_tj') }}" required>
                </div>
                <div class="col-md-4">
                    <label>Название RU</label>
                    <input name="title_ru" class="form-control" value="{{ old('title_ru') }}">
                </div>
                <div class="col-md-4">
                    <label>Название EN</label>
                    <input name="title_en" class="form-control" value="{{ old('title_en') }}">
                </div>

                {{-- Описание --}}
                <div class="col-12">
                    <label>Описание TJ</label>
                    <textarea name="description_tj" class="form-control" rows="3">{{ old('description_tj') }}</textarea>
                </div>
                <div class="col-12">
                    <label>Описание RU</label>
                    <textarea name="description_ru" class="form-control" rows="3">{{ old('description_ru') }}</textarea>
                </div>
                <div class="col-12">
                    <label>Описание EN</label>
                    <textarea name="description_en" class="form-control" rows="3">{{ old('description_en') }}</textarea>
                </div>

                {{-- Файл --}}
                <div class="col-md-6">
                    <label>Файл *</label>
                    <input type="file" name="file" class="form-control" required>
                </div>

                {{-- Дата публикации --}}
                <div class="col-md-3">
                    <label>Дата публикации</label>
                    <input type="date" name="published_at" class="form-control" value="{{ old('published_at') }}">
                </div>

                {{-- Статус --}}
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
                        <label class="form-check-label">Активен</label>
                    </div>
                </div>

                {{-- Кнопки --}}
                <div class="col-12 mt-3">
                    <button class="btn btn-success">Сохранить</button>
                    <a href="{{ route('documents.index') }}" class="btn btn-secondary">Назад</a>
                </div>
            </div>
        </form>
    </div>
@endsection

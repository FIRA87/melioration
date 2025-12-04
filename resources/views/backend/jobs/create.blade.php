@extends('admin.admin_dashboard')
@section('admin')
    <div class="container py-4">
        <h3>Добавить вакансию</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-4">
                    <label>Заголовок TJ *</label>
                    <input name="title_tj" class="form-control" value="{{ old('title_tj') }}" required>
                </div>
                <div class="col-md-4">
                    <label>Заголовок RU</label>
                    <input name="title_ru" class="form-control" value="{{ old('title_ru') }}">
                </div>
                <div class="col-md-4">
                    <label>Заголовок EN</label>
                    <input name="title_en" class="form-control" value="{{ old('title_en') }}">
                </div>

                <div class="col-md-4">
                    <label>Изображение</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>

                <div class="col-md-8">
                    <label>Attachments (pdf / images) — можно несколько</label>
                    <input type="file" name="attachments[]" multiple class="form-control" accept=".pdf,image/*">
                </div>

                <div class="col-12">
                    <label>Описание RU</label>
                    <textarea name="description_ru" class="form-control" rows="4">{{ old('description_ru') }}</textarea>
                </div>
                <div class="col-12">
                    <label>Описание TJ</label>
                    <textarea name="description_tj" class="form-control" rows="4">{{ old('description_tj') }}</textarea>
                </div>
                <div class="col-12">
                    <label>Описание EN</label>
                    <textarea name="description_en" class="form-control" rows="4">{{ old('description_en') }}</textarea>
                </div>

                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <ul class="nav nav-tabs nav-bordered" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                                    aria-selected="false" tabindex="-1" role="tab">
                                    Требования [RU]
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link active"
                                    aria-selected="true" role="tab">
                                    Требования [TJ]
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#messages-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                                    aria-selected="false" tabindex="-1" role="tab">
                                    Требования [EN]
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="home-b1" role="tabpanel">
                                <textarea id="summernote" name="requirements_ru" id="home-b1" cols="107" rows="10"
                                    class="form-control my-editor">Текст RU</textarea>
                            </div>
                            <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                <textarea id="summernote2" name="requirements_tj" id="profile-b1" cols="107" rows="10"
                                    class="form-control my-editor">Текст TJ</textarea>
                            </div>
                            <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                <textarea id="summernote3" name="requirements_en" id="messages-b1" cols="107" rows="10"
                                    class="form-control my-editor">Текст EN</textarea>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <label>Локация</label>
                    <input name="location" class="form-control" value="{{ old('location') }}">
                </div>
                <div class="col-md-3">
                    <label>Зарплата</label>
                    <input name="salary" class="form-control" value="{{ old('salary') }}">
                </div>
                <div class="col-md-3">
                    <label>Дата начала</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label>Дата окончания</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                </div>

                <div class="col-md-2">
                    <label>Сорт</label>
                    <input type="number" name="sort" class="form-control" value="{{ old('sort', 0) }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
                        <label class="form-check-label">Активна</label>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <button class="btn btn-success">Сохранить</button>
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">Назад</a>
                </div>
            </div>
        </form>
    </div>
@endsection

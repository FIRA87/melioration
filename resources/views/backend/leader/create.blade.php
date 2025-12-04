@extends('admin.admin_dashboard')
@section('admin')
    <div class="content">
        <div class="container-fluid">

            <div class="page-title-box">
                <h4 class="page-title">Добавить руководителя</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Добавить руководителя</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('leader.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Фото</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <img id="previewImage" src="{{ asset('upload/no-image.jpg') }}"
                                        class="mt-2 rounded border" width="120">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label>ФИО [RU]</label>
                                        <input type="text" name="title_ru" class="form-control" value="{{ old('title_ru') }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>ФИО [TJ]</label>
                                        <input type="text" name="title_tj" class="form-control" value="{{ old('title_tj') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>ФИО [EN]</label>
                                        <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Должность [RU]</label>
                                        <input type="text" name="position_ru" class="form-control" value="{{ old('position_ru') }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Должность [TJ]</label>
                                        <input type="text" name="position_tj" class="form-control" value="{{ old('position_tj') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Должность [EN]</label>
                                        <input type="text" name="position_en" class="form-control" value="{{ old('position_en') }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Телефон</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Рабочие дни</label>
                                        <input type="text" name="working_days" class="form-control"
                                            placeholder="Пн–Пт, 09:00–17:00" value="{{ old('working_days') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="subscriber_send_option" class="form-label">Статус </label>
                                        <select class="form-select" id="subscriber_send_option" name="status">
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Активный</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Неактивный</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 ">
                                        <label for="sort" class="form-label">Позиция</label>
                                        <input class="form-control" type="number" id="sort" name="sort"
                                            autofocus="" value="{{ old('sort') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="slug" class="form-label">URL(адрес) </label>
                                        <input class="form-control" type="text" id="slug" name="slug"
                                            autofocus="" value="{{ old('slug') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <ul class="nav nav-tabs nav-bordered" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                                                aria-selected="false" tabindex="-1"role="tab">ТЕКСТ [RU] </a>
                                        </li>
                                        <li class="nav-item" role="presentation"><a href="#profile-b1" data-bs-toggle="tab"
                                                aria-expanded="true" class="nav-link active" aria-selected="true"
                                                role="tab">ТЕКСТ [TJ] </a></li>
                                        <li class="nav-item" role="presentation"> <a href="#messages-b1"
                                                data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                                                aria-selected="false" tabindex="-1" role="tab"> ТЕКСТ [EN] </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="home-b1" role="tabpanel">
                                            <textarea id="summernote" name="text_ru" id="home-b1" cols="107" rows="10"
                                                class="form-control my-editor">{{ old('text_ru', 'Текст RU') }}</textarea>
                                        </div>
                                        <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                            <textarea id="summernote2" name="text_tj" id="profile-b1" cols="107" rows="10"
                                                class="form-control my-editor">{{ old('text_tj', 'Текст TJ') }}</textarea>
                                        </div>
                                        <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                            <textarea id="summernote3" name="text_en" id="messages-b1" cols="107" rows="10"
                                                class="form-control my-editor">{{ old('text_en', 'Текст EN') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-success"><i class="mdi mdi-content-save"></i>
                                    Сохранить </button>
                                <a href="{{ route('leader.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('photo').addEventListener('change', e => {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('previewImage').src = e.target.result;
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
@endsection

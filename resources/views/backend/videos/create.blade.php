@extends('admin.admin_dashboard')
@section('heading', 'Добавить видео')

@section('admin')
    <div class="content-wrapper">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a href="{{ route('all.video') }}" class="btn btn-primary">Назад</a>
                        </div>
                        <h4 class="fw-bold py-3 mb-4">Добавить видео</h4>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('store.video') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">Информация о видео</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group mb-3">
                                    <label for="title_ru" class="form-label">Название RU</label>
                                    <input type="text" id="title_ru" class="form-control" name="title_ru" required value="{{ old('title_ru') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="title_tj" class="form-label">Название TJ</label>
                                    <input type="text" id="title_tj" class="form-control" name="title_tj" required value="{{ old('title_tj') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="title_en" class="form-label">Название EN</label>
                                    <input type="text" id="title_en" class="form-control" name="title_en" required value="{{ old('title_en') }}">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="video_url" class="form-label">Ссылка на видео *</label>
                                    <input class="form-control" type="text" id="video_url" name="video_url" required value="{{ old('video_url') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="caption" class="form-label">Обложка *</label>
                                    <input class="form-control" type="file" id="caption" name="caption" required>
                                </div>

                                <div class="mb-3">
                                    <label for="position" class="form-label">Позиция</label>
                                    <input class="form-control" type="number" id="position" name="position" min="0" value="{{ old('position', 0) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="status" class="form-label">Статус</label>
                                    <select class="form-select" name="status" required>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Активный</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Неактивный</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    title_ru: { required: true },
                    title_tj: { required: true },
                    title_en: { required: true },
                    video_url: { required: true },
                    caption: { required: true },
                },
                messages: {
                    title_ru: { required: 'Введите название RU' },
                    title_tj: { required: 'Введите название TJ' },
                    title_en: { required: 'Введите название EN' },
                    video_url: { required: 'Введите ссылку на видео' },
                    caption: { required: 'Загрузите обложку' },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group, .mb-3').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection

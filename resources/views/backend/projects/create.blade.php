@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('all.projects') }}">Назад</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Проект</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Добавить </h4>


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul style="margin-bottom: 0;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="myForm" method="POST" action="{{ route('store.projects') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {{-- НАЗВАНИЯ --}}
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Название RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru"
                                                value="{{ old('title_ru') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Название TJ <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="title_tj" name="title_tj" class="form-control"
                                                value="{{ old('title_tj') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN</label>
                                            <input type="text" id="title_en" name="title_en" class="form-control"
                                                value="{{ old('title_en') }}">
                                        </div>
                                    </div>

                                    {{-- НОВОЕ ПОЛЕ: SLUG --}}
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="slug" class="form-label">Slug (URL)</label>
                                            <input type="text" id="slug" name="slug" class="form-control"
                                                value="{{ old('slug') }}">
                                            <small class="text-muted">Оставьте пустым для автогенерации.</small>
                                        </div>
                                    </div>

                                    {{-- ИЗОБРАЖЕНИЕ --}}
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Изображение <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" id="image" name="image" class="form-control"
                                                accept="image/*" required>
                                        </div>
                                    </div>

                                    {{-- НОВОЕ ПОЛЕ: ГАЛЕРЕЯ --}}
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="gallery" class="form-label">Галерея (множественное)</label>
                                            <input type="file" id="gallery" name="gallery[]" class="form-control"
                                                accept="image/*" multiple>
                                            <small class="text-muted">Можно выбрать несколько файлов.</small>
                                        </div>
                                    </div>

                                    {{-- НОВЫЕ ПОЛЯ: ДАТЫ --}}
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="start_date" class="form-label">Дата начала</label>
                                            <input type="date" id="start_date" name="start_date" class="form-control"
                                                value="{{ old('start_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="end_date" class="form-label">Дата окончания</label>
                                            <input type="date" id="end_date" name="end_date" class="form-control"
                                                value="{{ old('end_date') }}">
                                        </div>
                                    </div>

                                    {{-- СОРТИРОВКА --}}
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="sort" class="form-label">Сортировка</label>
                                            <input type="number" id="sort" name="sort" class="form-control"
                                                value="{{ old('sort', 0) }}" min="0">
                                        </div>
                                    </div>

                                    {{-- СТАТУС --}}
                                    <div class="col-md-4">
                                        <div class="form-group mb-4 d-flex align-items-center" style="gap: 12px;">
                                            <label class="form-label mb-0 fw-semibold"
                                                style="font-size: 15px; margin-right: 35px;">Статус:</label>

                                            <div class="d-flex align-items-center" style="gap: 8px;">
                                                <div class="form-check form-switch m-0 p-0">
                                                    <input type="checkbox" class="form-check-input" id="statusCheckbox"
                                                        name="status" value="1" checked
                                                        style="width: 2.5rem; height: 1.3rem; cursor: pointer;">
                                                </div>

                                                <span id="status-label" class="text-success fw-bold"
                                                    style="font-size: 15px;"> Активный </span>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ТЕКСТОВЫЕ ПОЛЯ --}}
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <ul class="nav nav-tabs nav-bordered" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a href="#text_ru" data-bs-toggle="tab" aria-expanded="false"
                                                        class="nav-link" aria-selected="false" tabindex="-1"
                                                        role="tab">
                                                        ТЕКСТ [RU]
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="#text_tj" data-bs-toggle="tab" aria-expanded="true"
                                                        class="nav-link active" aria-selected="true" role="tab">
                                                        ТЕКСТ [TJ]
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="#text_en" data-bs-toggle="tab" aria-expanded="false"
                                                        class="nav-link" aria-selected="false" tabindex="-1"
                                                        role="tab">
                                                        ТЕКСТ [EN]
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane" id="text_ru" role="tabpanel">
                                                    <textarea name="text_ru" id="summernote" cols="107" rows="10" class="form-control my-editor">{{ old('text_ru') }}</textarea>
                                                </div>
                                                <div class="tab-pane show active" id="text_tj" role="tabpanel">
                                                    <textarea name="text_tj" id="summernote2" cols="107" rows="10" class="form-control my-editor">{{ old('text_tj') }}</textarea>
                                                </div>
                                                <div class="tab-pane" id="text_en" role="tabpanel">
                                                    <textarea name="text_en" id="summernote3" cols="107" rows="10" class="form-control my-editor">{{ old('text_en') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                            <i class="mdi mdi-content-save"></i> Сохранить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Игнорируем элементы, скрытые Summernote, для корректной валидации
        $.validator.setDefaults({
            ignore: ":hidden, .note-editor *"
        });

        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    title_tj: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },
                    text_tj: {
                        required: true,
                    },

                    // ДОБАВЛЕНЫ НОВЫЕ ПРАВИЛА ВАЛИДАЦИИ ДЛЯ ПОЛЕЙ, КОТОРЫЕ МОГЛИ БЛОКИРОВАТЬ ОТПРАВКУ
                    slug: {
                        required: false, // Необязательно
                    },
                    start_date: {
                        required: false, // Необязательно
                        date: true // Проверяем, что если заполнено, то это дата
                    },
                    end_date: {
                        required: false, // Необязательно
                        date: true // Проверяем, что если заполнено, то это дата
                    },
                    'gallery[]': {
                        required: false, // Необязательно для галереи
                    },
                    status: {
                        required: false,
                    },
                },
                messages: {
                    title_tj: {
                        required: 'Пожалуйста, введите название на таджикском',
                    },
                    image: {
                        required: 'Пожалуйста, загрузите основное изображение',
                    },
                    text_tj: {
                        required: 'Пожалуйста, введите текст на таджикском',
                    },

                    // СООБЩЕНИЯ ДЛЯ НОВЫХ ПОЛЕЙ (необязательные, но могут быть полезны)
                    start_date: {
                        date: 'Пожалуйста, введите корректную дату начала',
                    },
                    end_date: {
                        date: 'Пожалуйста, введите корректную дату окончания',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    // Корректно размещаем ошибки для скрытых полей Summernote
                    if (element.hasClass('my-editor')) {
                        error.insertAfter(element.siblings('.note-editor'));
                    } else {
                        element.closest('.form-group').append(error);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    // Корректно подсвечиваем поле summernote
                    if ($(element).hasClass('my-editor')) {
                        $(element).siblings('.note-editor').find('.note-editable').addClass(
                            'is-invalid');
                    } else {
                        $(element).addClass('is-invalid');
                    }
                },
                unhighlight: function(element, errorClass, validClass) {
                    if ($(element).hasClass('my-editor')) {
                        $(element).siblings('.note-editor').find('.note-editable').removeClass(
                            'is-invalid');
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                },
            });
        });
    </script>

    <script>
        // Скрипт для изменения текста статуса
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('statusCheckbox');
            const label = document.getElementById('status-label');

            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    label.textContent = 'Активный';
                    label.classList.remove('text-muted');
                    label.classList.add('text-success', 'fw-bold');
                } else {
                    label.textContent = 'Неактивный';
                    label.classList.remove('text-success', 'fw-bold');
                    label.classList.add('text-muted');
                }
            });
        });
    </script>

@endsection

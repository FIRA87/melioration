@extends('admin.admin_dashboard')
@section('admin')
    <style>
        #status {
            display: block !important;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('all.category') }}">Назад</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Изменить категорию</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Редактировать категорию</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="myForm" method="POST" action="{{ route('update.category') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $category->id }}">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Название RU</label>
                                            <input type="text" id="title_ru" name="title_ru" class="form-control"
                                                value="{{ old('title_ru', $category->title_ru) }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Название TJ</label>
                                            <input type="text" id="title_tj" name="title_tj" class="form-control"
                                                value="{{ old('title_tj', $category->title_tj) }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN</label>
                                            <input type="text" id="title_en" name="title_en" class="form-control"
                                                value="{{ old('title_en', $category->title_en) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="position" class="form-label">Позиция</label>
                                            <input type="text" id="position" name="position" class="form-control"
                                                value="{{ old('position', $category->position) }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="status" class="form-label">Статус <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="status" name="status" required
                                                style="display: block !important;">
                                                <option value="1" @if (old('status', $category->status) == 1) selected @endif>
                                                    Активный</option>
                                                <option value="0" @if (old('status', $category->status) == 0) selected @endif>
                                                    Неактивный</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                            <i class="mdi mdi-content-save"></i> Обновить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->

    <script type="text/javascript">
        // Не скрывать селекты при валидации
        $.validator.setDefaults({
            ignore: []
        });

        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    title_ru: {
                        required: true
                    },
                    title_tj: {
                        required: true
                    },
                    title_en: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                },
                messages: {
                    title_ru: {
                        required: 'Пожалуйста, введите название категории RU'
                    },
                    title_tj: {
                        required: 'Пожалуйста, введите название категории TJ'
                    },
                    title_en: {
                        required: 'Пожалуйста, введите название категории EN'
                    },
                    status: {
                        required: 'Пожалуйста, выберите статус категории'
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
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

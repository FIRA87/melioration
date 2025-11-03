@extends('admin.admin_dashboard')
@section('heading', 'Ссылка')

@section('admin')

    <div class="content-fluid">
        <div class="container-fluid flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Добавить ссылку</span> </h4>
            <form method="POST" action="{{ route('store.links') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Ссылка</h5>

                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 ">
                                            <label for="title_ru" class="form-label">Название RU *</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru"
                                                required>
                                        </div>

                                        <div class="form-group mb-3 ">
                                            <label for="title_tj" class="form-label">Название TJ *</label>
                                            <input type="text" id="title_tj" class="form-control" name="title_tj"
                                                required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN *</label>
                                            <input type="text" id="title_en" class="form-control" name="title_en"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="url" class="form-label">Адрес ссылки *</label>
                                            <input class="form-control" type="text" id="url" name="url"
                                                autofocus="">
                                        </div>

                                        <div class="mb-3 ">
                                            <label for="img" class="form-label">Изображение *</label>
                                            <input class="form-control" type="file" id="img" name="img"
                                                autofocus="">
                                        </div>

                                        <div class="mb-3 ">
                                            <label for="sort" class="form-label">Позиция</label>
                                            <input class="form-control" type="number" id="sort" name="sort"
                                                autofocus="">
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="status" class="form-label">Статус</label>
                                            <select class="form-select" name="status" aria-invalid="false"
                                                style="display: block" id="status">
                                                <option value="1" selected>Активный</option>
                                                <option value="No">Неактивный</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Сохранить</button>
                </div>
            </form>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    title_ru: {
                        required: true,
                    },

                    title_tj: {
                        required: true,
                    },

                    title_en: {
                        required: true,
                    },

                },
                messages: {
                    title_ru: {
                        required: 'Пожалуйста, введите название  RU',
                    },
                    title_tj: {
                        required: 'Пожалуйста, введите название  TJ',
                    },
                    title_en: {
                        required: 'Пожалуйста, введите название  EN',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>


@endsection

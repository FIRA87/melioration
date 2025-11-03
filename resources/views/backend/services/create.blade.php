@extends('admin.admin_dashboard')
@section('heading', 'Service')

@section('admin')

    <div class="content-fluid">
        <div class="container-fluid flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Добавить</span> </h4>
            <form method="POST" action="{{ route('store.services') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Услуга</h5>

                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3 ">
                                            <label for="title_ru" class="form-label">Название RU *</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3 ">
                                            <label for="title_tj" class="form-label">Название TJ *</label>
                                            <input type="text" id="title_tj" class="form-control" name="title_tj"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN *</label>
                                            <input type="text" id="title_en" class="form-control" name="title_en"
                                                   required>
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="sort" class="form-label">Сортировка</label>
                                            <input type="number" id="sort" name="sort" class="form-control" value="0" min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="icon" class="form-label">Иконка</label>
                                            <input class="form-control" type="text" id="icon" name="icon" >
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group mb-4 d-flex align-items-center" style="gap: 12px;">
                                            <label class="form-label mb-0 fw-semibold" style="font-size: 15px; margin-right: 35px;">Статус:</label>

                                            <div class="d-flex align-items-center" style="gap: 8px;">
                                                <div class="form-check form-switch m-0 p-0">
                                                    <input type="checkbox"
                                                           class="form-check-input"
                                                           id="statusCheckbox"
                                                           name="status"
                                                           value="1"
                                                           checked
                                                           style="width: 2.5rem; height: 1.3rem; cursor: pointer;">
                                                </div>

                                                <span id="status-label" class="text-success fw-bold" style="font-size: 15px;"> Активный </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <ul class="nav nav-tabs nav-bordered" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" tabindex="-1" role="tab">ТЕКСТ [RU]  </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link active" aria-selected="true" role="tab">ТЕКСТ [TJ]</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="#messages-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" tabindex="-1" role="tab">ТЕКСТ [EN] </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane" id="home-b1" role="tabpanel">
                                                    <textarea id="summernote" name="text_ru" id="home-b1" cols="107" rows="10" class="form-control my-editor">Текст RU</textarea>
                                                </div>
                                                <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                                    <textarea id="summernote2" name="text_tj" id="profile-b1" cols="107" rows="10" class="form-control my-editor">Текст TJ</textarea>
                                                </div>
                                                <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                                    <textarea id="summernote3" name=text_en" id="messages-b1" cols="107" rows="10" class="form-control my-editor">Текст EN</textarea>
                                                </div>
                                            </div>
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

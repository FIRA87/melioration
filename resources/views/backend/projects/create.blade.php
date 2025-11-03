@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
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
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Добавить </h4>
                            <form id="myForm" method="POST" action="{{ route('store.projects') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Название RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Название TJ <span class="text-danger">*</span></label>
                                            <input type="text" id="title_tj" name="title_tj" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN</label>
                                            <input type="text" id="title_en" name="title_en" class="form-control">
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Изображение <span class="text-danger">*</span></label>
                                            <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="sort" class="form-label">Сортировка</label>
                                            <input type="number" id="sort" name="sort" class="form-control" value="0" min="0">
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
                                                    <a href="#text_ru" data-bs-toggle="tab" aria-expanded="false"
                                                        class="nav-link" aria-selected="false" tabindex="-1" role="tab">
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
                                                        class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                                                        ТЕКСТ [EN]
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane" id="text_ru" role="tabpanel">
                                                    <textarea name="text_ru" id="summernote" cols="107" rows="10" class="form-control my-editor"></textarea>
                                                </div>
                                                <div class="tab-pane show active" id="text_tj" role="tabpanel">
                                                    <textarea name="text_tj" id="summernote2" cols="107" rows="10" class="form-control my-editor" required></textarea>
                                                </div>
                                                <div class="tab-pane" id="text_en" role="tabpanel">
                                                    <textarea name="text_en" id="summernote3" cols="107" rows="10" class="form-control my-editor"></textarea>
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
                                <!-- end row-->
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <script type="text/javascript">
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
                    status: {
                        required: false,
                    },
                },
                messages: {
                    title_tj: {
                        required: 'Пожалуйста, введите название на таджикском',
                    },
                    image: {
                        required: 'Пожалуйста, загрузите изображение',
                    },
                    text_tj: {
                        required: 'Пожалуйста, введите текст на таджикском',
                    },
                    status: {
                        required: 'Пожалуйста, выберите статус',
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


@extends('admin.admin_dashboard')
@section('admin')

    <style>
        .form-check-input {
            width: 2.6rem;
            height: 1.4rem;
            cursor: pointer;
            transition: 0.25s ease;
        }
        .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
        }
        .form-check-input:hover {
            box-shadow: 0 0 6px rgba(0, 150, 0, 0.3);
        }
    </style>



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
                        <h4 class="page-title">Президент</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Редактировать президента</h4>
                            <form id="myForm" method="POST" action="{{ route('update.projects') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $project->id }}">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Название RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru" value="{{ $project->title_ru }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Название TJ <span class="text-danger">*</span></label>
                                            <input type="text" id="title_tj" name="title_tj" class="form-control" value="{{ $project->title_tj }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN</label>
                                            <input type="text" id="title_en" name="title_en" class="form-control" value="{{ $project->title_en }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="slug" class="form-label">Slug (URL) <span class="text-danger">*</span></label>
                                            <input type="text" id="slug" name="slug" class="form-control" value="{{ $project->slug }}" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Изображение</label>
                                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                            @if($project->image)
                                                <img src="{{ asset($project->image) }}" alt="{{ $project->title_tj }}" style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="sort" class="form-label">Сортировка</label>
                                            <input type="number" id="sort" name="sort" class="form-control" value="{{ $project->sort }}" min="0">
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
                                                    <textarea name="text_ru" id="summernote" cols="107" rows="10" class="form-control my-editor">{!! $project->text_ru !!}</textarea>
                                                </div>
                                                <div class="tab-pane show active" id="text_tj" role="tabpanel">
                                                    <textarea name="text_tj" id="summernote2" cols="107" rows="10" class="form-control my-editor" required>{!! $project->text_tj !!}</textarea>
                                                </div>
                                                <div class="tab-pane" id="text_en" role="tabpanel">
                                                    <textarea name="text_en" id="summernote3" cols="107" rows="10" class="form-control my-editor">{!! $project->text_en !!}</textarea>
                                                </div>
                                            </div>
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
                                                           value="1" {{ $project->status ? 'checked' : '' }}
                                                           style="width: 2.5rem; height: 1.3rem; cursor: pointer;"
                                                        {{ isset($project) && $project->status == 1 ? 'checked' : '' }}>
                                                </div>

                                                <span id="status-label" class="{{ isset($project) && $project->status == 1 ? 'text-success fw-bold' : 'text-muted' }}" style="font-size: 15px;">
                {{ isset($project) && $project->status == 1 ? 'Активный' : 'Неактивный' }}
            </span>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"> <i class="mdi mdi-content-save"></i> Обновить  </button>
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

        $.validator.setDefaults({
            ignore: []
        });


        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    title_tj: {
                        required: true,
                    },
                    slug: {
                        required: false,
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
                    slug: {
                        required: 'Пожалуйста, введите slug',
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

    <script>
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


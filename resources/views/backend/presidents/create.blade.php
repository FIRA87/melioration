@extends('admin.admin_dashboard')
@section('admin')
@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 
 

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
                            <li class="breadcrumb-item"><a href="{{ route('all.presidents') }}">Назад</a></li>
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
                        <h4 class="header-title">Добавить президента</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="myForm" method="POST" action="{{ route('store.presidents') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="title_ru" class="form-label">Название RU</label>
                                        <input type="text" id="title_ru" class="form-control" name="title_ru" value="{{ old('title_ru') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="title_tj" class="form-label">Название TJ <span class="text-danger">*</span></label>
                                        <input type="text" id="title_tj" name="title_tj" class="form-control" required value="{{ old('title_tj') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="title_en" class="form-label">Название EN</label>
                                        <input type="text" id="title_en" name="title_en" class="form-control" value="{{ old('title_en') }}">
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
                                        <input type="number" id="sort" name="sort" class="form-control" value="{{ old('sort', 0) }}" min="0">
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
                                                <textarea name="text_ru" id="summernote" cols="107" rows="10" class="form-control my-editor">{{ old('text_ru') }}</textarea>
                                            </div>
                                            <div class="tab-pane show active" id="text_tj" role="tabpanel">
                                                <textarea name="text_tj" id="summernote2" cols="107" rows="10" class="form-control my-editor" required>{{ old('text_tj') }}</textarea>
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
                    required: true,
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

@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif

@endsection


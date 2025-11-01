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
                                <li class="breadcrumb-item"><a href="{{ route('all.pages') }}">Назад</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Страница</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Редактировать страницу</h4>
                            <form id="myForm" method="POST" action="{{ route('update.pages') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $pages->id }}">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Название RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru"
                                                value="{{ $pages->title_ru }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Название TJ</label>
                                            <input type="text" id="title_tj" name="title_tj" class="form-control"
                                                value="{{ $pages->title_tj }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN</label>
                                            <input type="text" id="title_en" name="title_en" class="form-control"
                                                value="{{ $pages->title_en }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="meta_keywords_ru" class="form-label">Ключевые слова RU</label>
                                            <input type="text" id="meta_keywords_ru" class="form-control"
                                                name="meta_keywords_ru" value="{{ $pages->meta_keywords_ru }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="meta_keywords_tj" class="form-label">Ключевые слова TJ</label>
                                            <input type="text" id="meta_keywords_tj" name="meta_keywords_tj"
                                                class="form-control" value="{{ $pages->meta_keywords_tj }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="meta_keywords_en" class="form-label">Ключевые слова EN</label>
                                            <input type="text" id="meta_keywords_en" name="meta_keywords_en"
                                                class="form-control" value="{{ $pages->meta_keywords_en }}">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <ul class="nav nav-tabs nav-bordered" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false"
                                                        class="nav-link" aria-selected="false" tabindex="-1"
                                                        role="tab">
                                                        ТЕКСТ [RU]
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true"
                                                        class="nav-link active" aria-selected="true" role="tab">
                                                        ТЕКСТ [TJ]
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="#messages-b1" data-bs-toggle="tab" aria-expanded="false"
                                                        class="nav-link" aria-selected="false" tabindex="-1"
                                                        role="tab">
                                                        ТЕКСТ [EN]
                                                    </a>
                                                </li>
                                            </ul>
                                             <div class="tab-content">
                                                <div class="tab-pane" id="home-b1" role="tabpanel">
                                                    <textarea id="summernote" name="text_ru" id="home-b1" cols="107" rows="10" class="form-control my-editor">
                                            {!! $pages->text_ru !!}
                                        </textarea>
                                                </div>
                                                <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                                    <textarea id="summernote2" name="text_tj" id="profile-b1" cols="107" rows="10" class="form-control my-editor">
                                              {!! $pages->text_tj !!}
                                        </textarea>
                                                </div>
                                                <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                                    <textarea id="summernote3" name="text_en" id="messages-b1" cols="107" rows="10" class="form-control my-editor">
                                              {!! $pages->text_en !!}
                                        </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="active" class="form-label">Статус</label>
                                            <select class="form-select" id="active" name="status">
                                                <option value="1" @if ($pages->status == '1') selected @endif>
                                                    Активный</option>
                                                <option value="0" @if ($pages->status == '0') selected @endif>
                                                    Неактивный</option>
                                            </select>
                                        </div>

                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="url" class="form-label">Адрес страницы</label>
                                            <input type="text" id="url" name="url" class="form-control"
                                                value="{{ $pages->url }}">
                                        </div>

                                    </div> <!-- end col -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Обновить</button>
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
                        required: 'Пожалуйста, введите название RU',
                    },
                    title_tj: {
                        required: 'Пожалуйста, введите название TJ',
                    },
                    title_en: {
                        required: 'Пожалуйста, введите название EN',
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

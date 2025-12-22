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
                            <h4 class="header-title">Добавить страницу</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form id="myForm" method="POST" action="{{ route('store.submenu') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-2">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Название RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru" value="{{ old('title_ru') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Название TJ</label>
                                            <input type="text" id="title_tj" name="title_tj" class="form-control" value="{{ old('title_tj') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN</label>
                                            <input type="text" id="title_en" name="title_en" class="form-control" value="{{ old('title_en') }}">
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
                                                    <textarea id="summernote" name="text_ru" id="home-b1" cols="107" rows="10" class="form-control my-editor">{{ old('text_ru', 'ТЕКСТ RU') }}</textarea>
                                                </div>
                                                <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                                    <textarea id="summernote2" name="text_tj" id="profile-b1" cols="107" rows="10" class="form-control my-editor">{{ old('text_tj', 'ТЕКСТ TJ') }}</textarea>
                                                </div>
                                                <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                                    <textarea id="summernote3" name="text_en" id="messages-b1" cols="107" rows="10"
                                                        class="form-control my-editor">{{ old('text_en', 'ТЕКСТ EN') }}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="status" class="form-label">Статус</label>
                                            <select class="form-select" id="active" name="status">
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Активный</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Неактивный</option>
                                            </select>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="sort" class="form-label">Сортировка</label>
                                            <input type="text" id="sort" name="sort" class="form-control" value="{{ old('sort') }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="status" class="form-label">Подменю</label>
                                            <select class="form-select" id="active" name="page_id">
                                                @foreach ($menuItem as $menu)
                                                    <option value="{{ $menu->id }}" {{ old('page_id') == $menu->id ? 'selected' : '' }}>{{ $menu->title_ru }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> <!-- end col -->


                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label for="images" class="form-label">Изображения (можно загрузить несколько)</label>
                                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                                            <small class="text-muted">Разрешены форматы: JPEG, PNG, JPG, GIF, WEBP. Максимальный размер: 5MB</small>
                                        </div>
                                        <div id="image-preview" class="row mt-2"></div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Сохранить</button>
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

                    title_fr: {
                        required: true,
                    },

                    title_es: {
                        required: true,
                    },

                    title_ch: {
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

                    title_fr: {
                        required: 'Пожалуйста, введите название FR',
                    },
                    title_es: {
                        required: 'Пожалуйста, введите название ES',
                    },
                    title_ch: {
                        required: 'Пожалуйста, введите название CH',
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

    <script type="text/javascript">
        // Image preview functionality
        document.getElementById('images').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            
            const files = e.target.files;
            
            if (files) {
                Array.from(files).forEach((file, index) => {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 mb-3';
                        
                        const card = document.createElement('div');
                        card.className = 'card';
                        card.innerHTML = `
                            <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2">
                                <small class="text-muted">${file.name}</small>
                            </div>
                        `;
                        
                        col.appendChild(card);
                        preview.appendChild(col);
                    }
                    
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
@endsection

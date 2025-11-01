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
                                <li class="breadcrumb-item"><a href="{{ route('all.news.post') }}"
                                        class="btn btn-primary">Назад</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">НОВОСТНАЯ СТАТЬЯ</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Добавить</h4>
                            <form id="myForm" method="POST" action="{{ route('store.news.post') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Заголовок RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Заголовок TJ</label>
                                            <input type="text" id="title_tj" class="form-control" name="title_tj">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Заголовок EN</label>
                                            <input type="text" id="title_en" class="form-control" name="title_en">
                                        </div>

                                        <div class="form-group col-md-6 my-3">
                                            <label for="image" class="form-label">Изображение</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>

                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="category_id" class="form-label">Категория</label>
                                            <select class="form-select" id="category_id" name="category_id">
                                                <option value="choose-category">Выберите категорию</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title_ru }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3" style="display: none">
                                            <label for="subcategory_id" class="form-label">Подкатегория</label>
                                            <select class="form-select" id="subcategory_id" name="subcategory_id">
                                                <option></option>
                                            </select>
                                        </div>

     
                                        <div class="form-group mb-3">
                                                <!-- Поле для выбора даты -->
                                                <div class="form-group mb-3">
                                                    <label for="post_date" class="form-label">Дата публикации</label>
                                                    <input type="date" id="post_date" class="form-control" name="post_date" placeholder="Выберите дату">
                                                </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="showImage" class="form-label"></label>
                                            <img src="{{ '/upload/no-image.jpg' }}"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image"
                                                id="showImage">
                                        </div>
                                    </div> <!-- end col -->

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
                                                    <textarea id="summernote" name="news_details_ru" id="home-b1" cols="107" rows="10" class="form-control my-editor">Текст RU</textarea>
                                                </div>
                                                <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                                    <textarea id="summernote2" name="news_details_tj" id="profile-b1" cols="107" rows="10" class="form-control my-editor">Текст TJ</textarea>
                                                </div>
                                                <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                                    <textarea id="summernote3" name="news_details_en" id="messages-b1" cols="107" rows="10" class="form-control my-editor">Текст EN</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                      <!--   <div class="row">
                                            <div class="col-lg-4">
                                                Тег [RU]
                                                <div>
                                                    <label class="form-label">Удалить</label>
                                                    <input type="text" class="selectize-close-btn selectized"
                                                        value="RU" tabindex="-1" style="display: none;"
                                                        name="tags_ru">
                                                    <div
                                                        class="selectize-control selectize-close-btn multi plugin-remove_button">
                                                        <div class="selectize-input items not-full has-options has-items">
                                                            <div data-value="awesome" class="active">"awesome"<a
                                                                    href="javascript:void(0)" class="remove"
                                                                    tabindex="-1" title="Удалить">×</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                Тег [TJ]
                                                <div>
                                                    <label class="form-label">Удалить</label>
                                                    <input type="text" class="selectize-close-btn selectized"
                                                        value="neatTJ" tabindex="-1" style="display: none;"
                                                        name="tags_tj">
                                                    <div
                                                        class="selectize-control selectize-close-btn multi plugin-remove_button">
                                                        <div class="selectize-input items not-full has-options has-items">
                                                            <div data-value="awesome" class="active">"awesome"<a
                                                                    href="javascript:void(0)" class="remove"
                                                                    tabindex="-1" title="Удалить">×</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                Тег [EN]
                                                <div>
                                                    <label class="form-label">Удалить</label>
                                                    <input type="text" class="selectize-close-btn selectized"
                                                        value="neat" tabindex="-1" style="display: none;"
                                                        name="tags_en">
                                                    <div
                                                        class="selectize-control selectize-close-btn multi plugin-remove_button">
                                                        <div class="selectize-input items not-full has-options has-items">
                                                            <div data-value="awesome" class="active">"awesome"<a
                                                                    href="javascript:void(0)" class="remove"
                                                                    tabindex="-1" title="Удалить">×</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check mb-2 form-check-primary">
                                                    <input class="form-check-input" type="checkbox" name="breaking_news"
                                                        value="1" id="customckeck1">
                                                    <label class="form-check-label" for="customckeck1">БЛОК 1</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check mb-2 form-check-primary">
                                                    <input class="form-check-input" type="checkbox" name="top_slider"
                                                        value=1" id="customckeck_2">
                                                    <label class="form-check-label" for="customckeck_2">Слайдер</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check mb-2 form-check-danger">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="first_section_three" value="1" id="customckeck3">
                                                    <label class="form-check-label" for="customckeck3">БЛОК 2</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check mb-2 form-check-danger">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="first_section_nine" value="1" id="customckeck4">
                                                    <label class="form-check-label" for="customckeck4">БЛОК 3</label>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 col-md-6">
                                                <label for="subscriber_send_option" class="form-label">Отправить рассылку
                                                    по подписчикам </label>
                                                <select class="form-select" id="subscriber_send_option"
                                                    name="subscriber_send_option">                                                 
                                                    <option value="0">Нет</option>
                                                     <option value="1">Да</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3 col-md-6">
                                                <label for="subscriber_send_option" class="form-label">Статус </label>
                                                <select class="form-select" id="subscriber_send_option" name="status">
                                                    <option value="1">Активный</option>
                                                    <option value="0">Неактивный</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-success waves-effect waves-light mt-2"><i
                                                    class="mdi mdi-content-save"></i>Сохранить</button>
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
                        required: 'Пожалуйста, введите заголовок RU',
                    },
                    title_tj: {
                        required: 'Пожалуйста, введите заголовок TJ',
                    },
                    title_en: {
                        required: 'Пожалуйста, введите заголовок EN',
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

            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                let category_id = $(this).val();

                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            let d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value=" ' + value.id + ' "> ' + value
                                    .title_ru + '</option>');
                            });
                        },
                    });
                } else {
                    alert('Пожалуйста выберите');
                }

            });
        })
    </script>

  
@endsection

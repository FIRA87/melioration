@extends('admin.admin_dashboard')
@section('heading', 'Video Create')

@section('admin')

    <div class="content-wrapper">
        <div class="container-fluid flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('all.video') }}" class="btn btn-primary">Назад</a></li>

                            </ol>
                        </div>
                        <h4 class="pfw-bold py-3 mb-4">Добавить видео</h4>
                    </div>
                </div>
            </div>


            <form method="POST" action="{{ route('store.video') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Видео</h5>

                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group mb-3 ">
                                           <label for="title_ru" class="form-label">Название RU</label>
                                           <input type="text" id="title_ru" class="form-control" name="title_ru" required>
                                       </div>

                                       <div class="form-group mb-3 ">
                                           <label for="title_tj" class="form-label">Название TJ</label>
                                           <input type="text" id="title_tj" class="form-control" name="title_tj" required>
                                       </div>

                                       <div class="form-group mb-3">
                                           <label for="title_en" class="form-label">Название EN</label>
                                           <input type="text" id="title_en" class="form-control" name="title_en" required>
                                       </div>
                                   </div>

                                  <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="video_url" class="form-label">Адрес видео *</label>
                                        <input class="form-control" type="text" id="video_url" name="video_url"  autofocus="" required>
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="caption" class="form-label">Обложка видео *</label>
                                        <input class="form-control" type="file" id="caption" name="caption"  autofocus="" required>
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="position" class="form-label">Позиция</label>
                                        <input class="form-control" type="text" id="position" name="position" autofocus="" required> 
                                    </div>

                                </div>
                                  <div class="col-md-12">
                                       <div class="form-group mb-3">
                                           <label for="status" class="form-label">Статус</label>
                                           <select class="form-select"  name="status" aria-invalid="false" style="display: block">
                                               <option value="Yes" selected>Активный</option>
                                               <option value="No" >Неактивный</option>

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
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    title_ru: {
                        required : true,
                    },

                    title_tj: {
                        required : true,
                    },

                    title_en: {
                        required : true,
                    },

                },
                messages :{
                    title_ru: {
                        required : 'Пожалуйста, введите название RU',
                    },
                    title_tj: {
                        required : 'Пожалуйста, введите название TJ',
                    },
                    title_en: {
                        required : 'Пожалуйста, введите название EN',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>


@endsection

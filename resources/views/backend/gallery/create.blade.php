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
                        <li class="breadcrumb-item"><a href="{{ route('all.category') }}">Назад</a></li>

                    </ol>
                </div>
                <h4 class="page-title">Галерея</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Добавить галерею</h4>
                <form id="myForm" method="POST" action="{{ route('store.gallery') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="title_ru" class="form-label">Название RU</label>
                                    <input type="text" id="title_ru" class="form-control" name="title_ru">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="title_tj" class="form-label">Название TJ</label>
                                    <input type="text" id="title_tj" name="title_tj" class="form-control" >
                                </div>

                            <div class="form-group mb-3">
                                <label for="title_en" class="form-label">Название EN</label>
                                <input type="text" id="title_en" name="title_en" class="form-control" >
                            </div>

                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            <div class="form-group col-md-6 my-3">
                                <label for="cover" class="form-label">Обложка галереи</label>
                                <input type="file"  class="form-control" name="cover" id="cover">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="showImage" class="form-label"></label>
                                <img src="{{ ('/upload/no-image.jpg') }}"  class="rounded-circle avatar-lg img-thumbnail" alt="profile-image" id="showImage">
                            </div>


                            <div class="form-group col-md-6 my-3">
                                <label for="images" class="form-label">Картинки галереи (можно выбрать несколько изображений)</label>
                                <input type="file"  class="form-control" name="images[]" multiple>
                            </div>

                        </div> <!-- end col -->

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <ul class="nav nav-tabs nav-bordered" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                                            ТЕКСТ [RU]
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link active" aria-selected="true" role="tab">
                                            ТЕКСТ [TJ]
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#messages-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                                            ТЕКСТ [EN]
                                        </a>
                                    </li>
                                </ul>
                                 <div class="tab-content">
                                    <div class="tab-pane" id="home-b1" role="tabpanel">
                                        <textarea id="summernote" name="text_ru" id="home-b1" cols="107" rows="10">ТЕКСТ [RU]</textarea>
                                    </div>
                                    <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                        <textarea id="summernote2" name="text_tj" id="profile-b1" cols="107" rows="10">ТЕКСТ [TJ]</textarea>
                                    </div>
                                    <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                        <textarea id="summernote3" name="text_en" id="messages-b1" cols="107" rows="10">ТЕКСТ [EN]</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i>Сохранить</button>
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

        $('#image').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    });

</script>


@endsection

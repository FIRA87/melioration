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
                            <li class="breadcrumb-item"><a href="{{ route('all.gallery') }}">Назад</a></li>

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
                        <h4 class="header-title">Редактировать галерею</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">

                            <div class="col-lg-12 d-flex">
                                <div class="col-md-2">
                                    <form action="/deletecover/{{ $gallery->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group col-md-6 my-3">
                                            <label for="cover" class="form-label">Обложка галереи</label>
                                            <img src="/upload/cover/{{ $gallery->cover }}" alt=""
                                                style="max-height: 150px; max-width: 150px"
                                                class="img-fluid rounded my-2">


                                        </div>
                                    </form>
                                </div>


                                <div class="form-group col-md-10 my-3 d-flex">
                                    @if (count($gallery->images) > 0)
                                        <label for="images" class="form-label">Картинки галереи</label>
                                        @foreach ($gallery->images as $item)
                                            <form action="/deleteimage/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger d-flex"
                                                    style="position:relative; left:35%">Удалить</button>
                                                <img src="/upload/gallery/{{ $item->image }}" alt=""
                                                    style="max-height: 150px; max-width: 150px"
                                                    class="img-fluid rounded  m-2">
                                            </form>
                                        @endforeach
                                    @endif

                                </div>


                            </div> <!-- end col -->

                            <form method="POST" action="{{ url('/gallery/update/' . $gallery->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-lg-12">

                                    <div class="form-group col-md-6 my-3">
                                        <label for="cover" class="form-label">Новая обложка</label>
                                        <input type="file" class="form-control" name="cover" id="cover">
                                    </div>

                                    <div class="form-group col-md-6 my-3">
                                        <label for="images" class="form-label">Новые картинки (можно выбрать несоклько
                                            изображений)</label>
                                        <input type="file" class="form-control" name="images[]" multiple>
                                    </div>





                                </div> <!-- end col -->

                                <div class="row"> 
                                       <div class="col-md-4"> 
                                       <div class="form-group mb-3">
                                        <label for="title_ru" class="form-label">Название RU</label>
                                        <input type="text" id="title_ru" class="form-control" name="title_ru"
                                            value="{{ old('title_ru', $gallery->title_ru) }}">
                                    </div>
                                 </div>  

                                 <div class="col-md-4"> 
                                      <div class="form-group mb-3">
                                        <label for="title_tj" class="form-label">Название TJ</label>
                                        <input type="text" id="title_tj" name="title_tj" class="form-control"
                                            value="{{ old('title_tj', $gallery->title_tj) }}">
                                    </div>
                                 </div> 

                                 <div class="col-md-4"> 
                                    <div class="form-group mb-3">
                                        <label for="title_en" class="form-label">Название EN</label>
                                        <input type="text" id="title_en" name="title_en" class="form-control"
                                            value="{{ old('title_en', $gallery->title_en) }}">
                                    </div>
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
                                                <textarea id="summernote" name="text_ru" id="home-b1" cols="107" rows="10">
                                                        {{ old('text_ru', $gallery->text_ru) }}
                                                    </textarea>
                                            </div>
                                            <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                                <textarea id="summernote2" name="text_tj" id="profile-b1" cols="107" rows="10">   {{ old('text_tj', $gallery->text_tj) }} </textarea>
                                            </div>
                                            <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                                <textarea id="summernote3" name="text_en" id="messages-b1" cols="107" rows="10">   {{ old('text_en', $gallery->text_en) }} </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                        <i class="mdi mdi-content-save"></i>Обновить</button>
                                </div>
                            </form>
                        </div>
                        <!-- end row-->

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

        $('#image').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    });
</script>
@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif

@endsection

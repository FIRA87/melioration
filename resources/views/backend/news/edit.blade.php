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
                            <li class="breadcrumb-item"><a href="{{ route('all.news') }}">Назад</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">НОВОСТНАЯ СТАТЬЯ</h4>
                </div>
            </div>

            @error('publish_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror


        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Редактировать новости</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form method="POST" action="{{ route('update.news', $news->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                            <input type="hidden" name="id" value="{{ $news->id }}">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="title_ru" class="form-label">Заголовок RU</label>
                                        <input type="text" id="title_ru" class="form-control @error('title_ru') is-invalid @enderror" name="title_ru"  value="{{ old('title_ru', $news->title_ru) }}">
                                        @error('title_ru')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="title_tj" class="form-label">Заголовок TJ</label>
                                        <input type="text" id="title_tj" class="form-control @error('title_tj') is-invalid @enderror" name="title_tj" value="{{ old('title_tj', $news->title_tj) }}">
                                        @error('title_tj')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="title_en" class="form-label">Заголовок EN</label>
                                        <input type="text" id="title_en" class="form-control @error('title_en') is-invalid @enderror" name="title_en" value="{{ old('title_en', $news->title_en) }}">
                                        @error('title_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 my-3">
                                        <label for="image" class="form-label">Изображение</label>
                                        <input type="file"  class="form-control" name="image" id="image">
                                    </div>

                                </div> <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="category_id" class="form-label">Категория</label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id', $news->category_id) == $cat->id ? 'selected': '' }}>{{ $cat->title_ru }}</option>

                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                  <div class="form-group mb-3">
                                        <!-- Поле для выбора даты -->
                                      <div class="form-group mb-3">
                                        <label for="publish_date" class="form-label">Дата публикации</label>
                                        <input type="date"  id="publish_date" class="form-control" name="publish_date" value="{{ old('publish_date', $news->publish_date) }}">
                                    </div>

                                  </div>

                                    <div class="form-group col-md-4">
                                        <label for="showImage" class="form-label"></label>
                                        <img src="{{ asset($news->image) }}"  class="rounded-circle avatar-lg img-thumbnail" alt="profile-image" id="showImage">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check mb-2 form-check-primary">
                                            <input class="form-check-input" type="checkbox" name="top_slider" value="1" id="customckeck_2"  {{ old('top_slider', $news->top_slider) == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="customckeck_2">Слайдер</label>
                                        </div>
                                    </div>
                                </div> <!-- end col -->


                                <div class="col-md-6">
                                    <div class="form-check mb-2 form-check-primary">
                                        <input class="form-check-input" type="checkbox" name="home_page" value="1" id="home_page_check" {{ old('home_page', $news->home_page) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="home_page_check">На главной</label>
                                    </div>
                                </div>

                                <!-- Задачи -->
                                <div class="col-md-12 mt-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Задачи (необязательно)</label>
                                        <select class="form-select" name="tasks[]" multiple size="5">
                                            @foreach ($tasks as $task)
                                                <option value="{{ $task->id }}" {{ (collect(old('tasks', $news->tasks->pluck('id')->toArray()))->contains($task->id)) ? 'selected' : '' }}>
                                                    {{ $task->title_ru }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Удерживайте Ctrl для выбора нескольких задач</small>
                                    </div>
                                </div>

                                <!-- Существующие изображения галереи -->
                                @if($news->images->count() > 0)
                                    <div class="col-md-12 mt-3">
                                        <h5>Существующие изображения галереи</h5>
                                        <div class="row">
                                            @foreach($news->images as $img)
                                                <div class="col-md-2 mb-2 position-relative" id="gallery-image-{{ $img->id }}">
                                                    <img src="{{ asset($img->image) }}" class="img-thumbnail" style="height: 100px; object-fit: cover;">
                                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="deleteGalleryImage({{ $img->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Новые изображения галереи -->
                                <div class="col-md-12 mt-3">
                                    <div class="form-group mb-3">
                                        <label for="gallery" class="form-label">Добавить изображения в галерею (необязательно)</label>
                                        <input type="file" class="form-control" name="gallery[]" id="gallery" multiple accept="image/*">
                                    </div>
                                    <div id="gallery-preview" class="row mt-2"></div>
                                </div>

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
                                                <textarea id="summernote" name="news_details_ru" id="home-b1" cols="107" rows="10" class="form-control my-editor">
                                                    {!! old('news_details_ru', $news->news_details_ru) !!}
                                                </textarea>

                                            </div>
                                            <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                                <textarea id="summernote2" name="news_details_tj" id="profile-b1" cols="107" rows="10" class="form-control my-editor">
                                                      {!! old('news_details_tj', $news->news_details_tj) !!}
                                                </textarea>
                                            </div>
                                            <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                                <textarea id="summernote3" name="news_details_en" id="messages-b1" cols="107" rows="10" class="form-control my-editor">
                                                      {!! old('news_details_en', $news->news_details_en) !!}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Сохранить</button>
                                    </div>
                                </div>
                                <!-- end row-->
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container -->
</div> <!-- content -->

<script>

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
                    required : 'Пожалуйста, введите заголовок RU',
                },
                title_tj: {
                    required : 'Пожалуйста, введите заголовок TJ',
                },
                title_en: {
                    required : 'Пожалуйста, введите заголовок EN',
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

<script>

    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            let category_id = $(this).val();

            if(category_id){
                $.ajax({
                    url:"{{ url('/subcategory/ajax')}}/"+category_id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data){
                        $('select[name="subcategory_id"]').html('');
                        let d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value=" '+ value.id +' "> ' + value.title_ru + '</option>');
                        });
                    },
                });
            } else {
                alert('Пожалуйста выберите');
            }

        });
    })
</script>


<script>
    // Превью новых изображений
    document.getElementById('gallery').addEventListener('change', function(e) {
        const preview = document.getElementById('gallery-preview');
        preview.innerHTML = '';

        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const col = document.createElement('div');
                col.className = 'col-md-2 mb-2';
                col.innerHTML = `<img src="${event.target.result}" class="img-thumbnail" style="width: 100%; height: 100px; object-fit: cover;">`;
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    });

    // Удаление изображения из галереи
    function deleteGalleryImage(id) {
        if (!confirm('Удалить это изображение?')) return;

        fetch(`/delete/gallery-image/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`gallery-image-${id}`).remove();
                    alert('Изображение удалено');
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif

@endsection

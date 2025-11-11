@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Редактировать проект</h4>
                <a href="{{ route('all.projects') }}" class="btn btn-secondary">Назад</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form id="myForm" method="POST" action="{{ route('update.projects') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $project->id }}">

                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Название TJ *</label>
                                <input type="text" name="title_tj" class="form-control" value="{{ $project->title_tj }}"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Название RU</label>
                                <input type="text" name="title_ru" class="form-control" value="{{ $project->title_ru }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Название EN</label>
                                <input type="text" name="title_en" class="form-control" value="{{ $project->title_en }}">
                            </div>


                            <div class="col-md-4 mt-3">
                                <label class="form-label">Slug (URL)</label>
                                <input type="text" name="slug" class="form-control" value="{{ $project->slug }}">
                            </div>


                            <div class="col-md-4 mt-3">
                                <label for="start_date" class="form-label">Дата начала</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ $project->start_date ?? '' }}">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="end_date" class="form-label">Дата окончания</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ $project->end_date ?? '' }}">
                            </div>


                            <div class="col-md-4 mt-3">
                                <label class="form-label">Изображение</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if ($project->image)
                                    <img src="{{ asset($project->image) }}" class="mt-2"
                                        style="width:100px; height:100px; object-fit:cover;">
                                @endif
                            </div>

                            <div class="col-md-4 mt-3">
                                <div class="form-group mb-3">
                                    <label for="gallery" class="form-label">Галерея (множественное)</label>
                                    <input type="file" id="gallery" name="gallery[]" class="form-control"
                                        accept="image/*" multiple>
                                    <small class="text-muted">Можно выбрать несколько файлов.</small>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Текущая галерея</label>
                                <div class="row" id="current_gallery_container">

                                    @if ($project->gallery && is_array($project->gallery))
                                        @foreach ($project->gallery as $index => $img_path)
                                            <div class="col-md-12 mb-3 gallery-image-item"
                                                id="gallery_item_{{ $index }}">
                                                <div class="card p-2 border">
                                                    <img src="{{ asset($img_path) }}" alt="Gallery Image"
                                                        class="img-fluid rounded" style="height: 150px; object-fit: cover;">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm mt-2 delete-gallery-img"
                                                        data-index="{{ $index }}" data-path="{{ $img_path }}"
                                                        data-project-id="{{ $project->id }}">
                                                        <i class="mdi mdi-delete"></i> Удалить
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted">Галерея пуста.</p>
                                    @endif
                                </div>
                            </div>



                            <div class="col-md-4 mt-3">
                                <label class="form-label">Сортировка</label>
                                <input type="number" name="sort" class="form-control"
                                    value="{{ $project->sort ?? 0 }}">
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="status" value="1"
                                        {{ $project->status ? 'checked' : '' }}>
                                    <label
                                        class="form-check-label">{{ $project->status ? 'Активный' : 'Неактивный' }}</label>
                                </div>
                            </div>


                            <div class="col-md-12 mt-3">
                                <ul class="nav nav-tabs nav-bordered mb-3">
                                    <li class="nav-item"><a href="#text_tj" data-bs-toggle="tab"
                                            class="nav-link active">Текст [TJ]</a></li>
                                    <li class="nav-item"><a href="#text_ru" data-bs-toggle="tab" class="nav-link">Текст
                                            [RU]</a></li>
                                    <li class="nav-item"><a href="#text_en" data-bs-toggle="tab" class="nav-link">Текст
                                            [EN]</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="text_tj">
                                        <textarea id="summernote" name="text_tj" class="form-control my-editor" rows="8" required>{!! $project->text_tj !!}</textarea>
                                    </div>
                                    <div class="tab-pane" id="text_ru">
                                        <textarea id="summernote2" name="text_ru" class="form-control my-editor" rows="8">{!! $project->text_ru !!}</textarea>
                                    </div>
                                    <div class="tab-pane" id="text_en">
                                        <textarea id="summernote3" name="text_en" class="form-control my-editor" rows="8">{!! $project->text_en !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-success">
                                    <i class="mdi mdi-content-save"></i> Обновить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).on('click', '.delete-gallery-img', function(e) {
            e.preventDefault();

            const button = $(this);
            const projectId = button.data('project-id');
            const imgIndex = button.data('index');
            const imgPath = button.data('path');
            const itemToRemove = $('#gallery_item_' + imgIndex);

            if (!confirm('Вы уверены, что хотите удалить это изображение из галереи?')) {
                return;
            }

            // Временно отключаем кнопку и добавляем индикатор загрузки
            button.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Удаление...'
            );

            // Отправка AJAX-запроса
            $.ajax({
                url: '/delete/projects/gallery/image', // МАРШРУТ, КОТОРЫЙ НУЖНО СОЗДАТЬ
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    project_id: projectId,
                    image_path: imgPath
                },
                success: function(response) {
                    if (response.success) {
                        // Визуальное удаление элемента без перезагрузки
                        itemToRemove.fadeOut(300, function() {
                            $(this).remove();
                            // Можно добавить временное уведомление об успехе (если у вас есть библиотека, например, Toastr)
                            // toastr.success(response.message || 'Изображение удалено.');
                            alert(response.message || 'Изображение удалено.');
                        });
                    } else {
                        // Если удаление не удалось на сервере
                        alert(response.message || 'Ошибка удаления изображения.');
                        button.prop('disabled', false).html(
                            '<i class="mdi mdi-delete"></i> Удалить'); // Восстанавливаем кнопку
                    }
                },
                error: function(xhr) {
                    // Обработка ошибок сети или сервера (500, 404 и т.д.)
                    console.error("AJAX Error:", xhr.responseText);
                    alert('Произошла ошибка при обращении к серверу.');
                    button.prop('disabled', false).html(
                        '<i class="mdi mdi-delete"></i> Удалить'); // Восстанавливаем кнопку
                }
            });
        });
    </script>

@endsection

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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form id="myForm" method="POST" action="{{ route('update.page') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $page->id }}">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Название RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru"
                                                value="{{ old('title_ru', $page->title_ru) }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Название TJ</label>
                                            <input type="text" id="title_tj" name="title_tj" class="form-control"
                                                value="{{ old('title_tj', $page->title_tj) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN</label>
                                            <input type="text" id="title_en" name="title_en" class="form-control"
                                                value="{{ old('title_en', $page->title_en) }}">
                                        </div>
                                    </div>



                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="meta_keywords_ru" class="form-label">Ключевые слова RU</label>
                                            <input type="text" id="meta_keywords_ru" class="form-control"
                                                name="meta_keywords_ru"
                                                value="{{ old('meta_keywords_ru', $page->meta_keywords_ru) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="meta_keywords_tj" class="form-label">Ключевые слова TJ</label>
                                            <input type="text" id="meta_keywords_tj" name="meta_keywords_tj"
                                                class="form-control"
                                                value="{{ old('meta_keywords_tj', $page->meta_keywords_tj) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="meta_keywords_en" class="form-label">Ключевые слова EN</label>
                                            <input type="text" id="meta_keywords_en" name="meta_keywords_en"
                                                class="form-control"
                                                value="{{ old('meta_keywords_en', $page->meta_keywords_en) }}">
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
                                                    <textarea id="summernote" name="text_ru" id="home-b1" cols="107" rows="10"
                                                        class="form-control my-editor">
                                            {!! old('text_ru', $page->text_ru) !!}
                                        </textarea>
                                                </div>
                                                <div class="tab-pane show" id="profile-b1" role="tabpanel">
                                                    <textarea id="summernote2" name="text_tj" id="profile-b1" cols="107" rows="10"
                                                        class="form-control my-editor">
                                              {!! old('text_tj', $page->text_tj) !!}
                                        </textarea>
                                                </div>
                                                <div class="tab-pane active" id="messages-b1" role="tabpanel">
                                                    <textarea id="summernote3" name="text_en" id="messages-b1" cols="107" rows="10"
                                                        class="form-control my-editor">
                                              {!! old('text_en', $page->text_en) !!}
                                        </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Existing Images -->
                                    @if ($page->images && $page->images->count() > 0)
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Существующие изображения</label>
                                                <div class="row" id="existing-images">
                                                    @foreach ($page->images as $image)
                                                        <div class="col-md-3 mb-3" id="image-{{ $image->id }}">
                                                            <div class="card">
                                                                <img src="{{ asset('upload/pages/' . $image->image) }}"
                                                                    class="card-img-top draggable-image"
                                                                    style="height: 150px; object-fit: cover; cursor: move;"
                                                                    draggable="true"
                                                                    data-url="{{ asset('upload/pages/' . $image->image) }}">
                                                                <div class="card-body p-2 text-center">
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm delete-image"
                                                                        data-image-id="{{ $image->id }}">
                                                                        <i class="mdi mdi-delete"></i> Удалить
                                                                    </button>
                                                                    <!-- Hidden checkbox for deletion -->
                                                                    <input type="checkbox" name="delete_images[]"
                                                                        value="{{ $image->id }}"
                                                                        class="d-none delete-checkbox-{{ $image->id }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- New Images Upload -->
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label for="images" class="form-label">Добавить новые
                                                изображения</label>
                                            <input type="file" class="form-control" id="images" name="images[]"
                                                multiple accept="image/*">
                                            <small class="text-muted">Разрешены форматы: JPEG, PNG, JPG, GIF, WEBP.
                                                Максимальный размер: 5MB</small>
                                        </div>
                                        <div id="image-preview" class="row mt-2"></div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="active" class="form-label">Статус</label>
                                            <select class="form-select" id="active" name="status">
                                                <option value="1" @if (old('status', $page->status) == '1') selected @endif>
                                                    Активный</option>
                                                <option value="0" @if (old('status', $page->status) == '0') selected @endif>
                                                    Неактивный</option>
                                            </select>
                                        </div>

                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="url" class="form-label">Адрес страницы</label>
                                            <input type="text" id="url" name="url" class="form-control"
                                                value="{{ old('url', $page->url) }}">
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

    <script type="text/javascript">
        // Image preview functionality for new uploads
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
                        // Добавляем класс draggable-image и атрибуты для перетаскивания
                        card.innerHTML = `
                            <img src="${e.target.result}"
                                 class="card-img-top draggable-image"
                                 style="height: 150px; object-fit: cover; cursor: move;"
                                 draggable="true"
                                 data-url="${e.target.result}">
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

        // Delete existing images via AJAX
        $(document).on('click', '.delete-image', function() {
            const imageId = $(this).data('image-id');
            const imageCard = $('#image-' + imageId);
            const button = $(this);

            if (confirm('Вы уверены, что хотите удалить это изображение?')) {
                // Disable button and show loading state
                button.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i> Удаление...');

                // Send AJAX request
                $.ajax({
                    url: '{{ route('pages.delete.image') }}',
                    method: 'POST',
                    data: {
                        image_id: imageId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Remove image card with animation
                            imageCard.fadeOut(300, function() {
                                $(this).remove();
                            });

                            // Show success message
                            if (typeof toastr !== 'undefined') {
                                toastr.success(response.message);
                            }
                        } else {
                            alert(response.message || 'Ошибка при удалении изображения');
                            button.prop('disabled', false).html(
                                '<i class="mdi mdi-delete"></i> Удалить');
                        }
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON?.message || 'Ошибка при удалении изображения';
                        alert(message);
                        button.prop('disabled', false).html('<i class="mdi mdi-delete"></i> Удалить');
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">
        /**
         * Обработка drag and drop для вставки изображений в редактор Summernote
         * Копирует полный HTML-тег изображения со всеми атрибутами
         */
        $(document).ready(function() {
            var draggedImageElement = null;
            var draggedImageHtml = null;

            // При начале перетаскивания изображения из галереи
            $(document).on('dragstart', '.draggable-image', function(e) {
                draggedImageElement = $(this);

                // Получаем все атрибуты изображения
                var src = draggedImageElement.attr('src') || draggedImageElement.data('url') || '';
                var className = draggedImageElement.attr('class') || '';
                var style = draggedImageElement.attr('style') || '';
                var draggable = draggedImageElement.attr('draggable') || 'true';
                var dataUrl = draggedImageElement.data('url') || src;

                // Создаем полный HTML-тег со всеми атрибутами
                var imgHtml = '<img';
                imgHtml += ' src="' + src + '"';
                if (className) {
                    imgHtml += ' class="' + className + '"';
                }
                if (style) {
                    imgHtml += ' style="' + style + '"';
                }
                if (draggable) {
                    imgHtml += ' draggable="' + draggable + '"';
                }
                if (dataUrl) {
                    imgHtml += ' data-url="' + dataUrl + '"';
                }
                imgHtml += '>';

                draggedImageHtml = imgHtml;

                e.originalEvent.dataTransfer.effectAllowed = 'copy';
                e.originalEvent.dataTransfer.setData('text/html', imgHtml);
            });

            // Визуальная обратная связь при наведении на редактор
            $(document).on('dragover', '.note-editable', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.originalEvent.dataTransfer.dropEffect = 'copy';
                $(this).addClass('drag-over');
            });

            $(document).on('dragleave', '.note-editable', function(e) {
                $(this).removeClass('drag-over');
            });

            // Обработчик drop для вставки изображений из галереи
            $(document).on('drop', '.note-editable', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('drag-over');

                if (draggedImageHtml) {
                    // Находим активный редактор Summernote
                    var $editable = $(this);
                    var $editor = $editable.closest('.note-editor');
                    var $textarea = null;

                    // Определяем активный таб и соответствующий textarea
                    var $activeTabPane = $editable.closest('.tab-pane');
                    var tabPaneId = $activeTabPane.attr('id');

                    // Определяем ID textarea на основе активного таба
                    var textareaId = null;
                    if (tabPaneId === 'home-b1') {
                        textareaId = 'summernote';
                    } else if (tabPaneId === 'profile-b1') {
                        textareaId = 'summernote2';
                    } else if (tabPaneId === 'messages-b1') {
                        textareaId = 'summernote3';
                    }

                    // Если нашли ID, используем его
                    if (textareaId) {
                        $textarea = $('#' + textareaId);
                    }

                    // Если не нашли по табу, пробуем другие способы
                    if ($textarea.length === 0) {
                        // Способ 1: через prev (стандартный способ Summernote)
                        $textarea = $editor.prev('textarea');
                    }

                    if ($textarea.length === 0) {
                        // Способ 2: через siblings
                        $textarea = $editor.siblings('textarea').first();
                    }

                    if ($textarea.length === 0) {
                        // Способ 3: через родительский элемент таба
                        $textarea = $activeTabPane.find('textarea').first();
                    }

                    if ($textarea.length > 0) {
                        // Вставляем изображение в место курсора или в конец, если курсор не установлен
                        try {
                            // Используем метод pasteHTML для вставки в место курсора
                            // Если курсор не установлен, вставится в конец
                            $textarea.summernote('pasteHTML', draggedImageHtml);
                        } catch (error) {
                            console.error('Ошибка при вставке изображения:', error);
                            // Fallback: если pasteHTML не сработал, добавляем в конец
                            try {
                                var currentContent = $textarea.summernote('code') || '';
                                var newContent = currentContent + draggedImageHtml;
                                $textarea.summernote('code', newContent);
                            } catch (fallbackError) {
                                console.error('Ошибка при fallback вставке:', fallbackError);
                                alert('Ошибка при вставке изображения');
                            }
                        }
                    } else {
                        console.error('Не удалось найти textarea для вставки изображения');
                        alert('Ошибка: не удалось найти редактор для вставки изображения');
                    }

                    draggedImageHtml = null;
                    draggedImageElement = null;
                    return false;
                }
            });

            // Очистка при завершении перетаскивания
            $(document).on('dragend', '.draggable-image', function() {
                draggedImageHtml = null;
                draggedImageElement = null;
            });
        });
    </script>



    <style>
        .note-editable.drag-over {
            background-color: #f0f8ff !important;
            border: 2px dashed #007bff !important;
        }
    </style>

@endsection

@extends('admin.admin_dashboard')
@section('admin')

@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 
<div class="container py-4">
    <h3>Редактировать вакансию</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">

            {{-- Заголовки --}}
            <div class="col-md-4">
                <label>Заголовок TJ *</label>
                <input name="title_tj" class="form-control" value="{{ old('title_tj', $job->title_tj) }}" required>
            </div>
            <div class="col-md-4">
                <label>Заголовок RU</label>
                <input name="title_ru" class="form-control" value="{{ old('title_ru', $job->title_ru) }}">
            </div>
            <div class="col-md-4">
                <label>Заголовок EN</label>
                <input name="title_en" class="form-control" value="{{ old('title_en', $job->title_en) }}">
            </div>

            {{-- Изображение --}}
            <div class="col-md-4">
                <label>Изображение (новое)</label>
                <input type="file" name="image" accept="image/*" class="form-control">
                @if ($job->image)
                    <div class="mt-2">
                        <img src="{{ asset($job->image) }}" style="width:160px;height:100px;object-fit:cover">
                    </div>
                @endif
            </div>

            {{-- Вложения --}}

            <div class="col-12 mb-3">
                <label class="form-label">Добавить новые файлы</label>
                <input type="file" name="attachments[]" class="form-control" multiple>

                @if ($job->attachments)
                    <div class="mt-3" id="attachments-list">
                        <h6>Текущие вложения (<span id="attachment-count">{{ count($job->attachments ?? []) }}</span>):
                        </h6>
                        @foreach ($job->attachments as $i => $att)
                            <div class="d-flex align-items-center mb-2" id="attachment-{{ $i }}"
                                style="gap:10px;">
                                <a href="{{ route('admin.jobs.download.attachment', ['job' => $job->id, 'index' => $i]) }}"
                                    target="_blank">
                                    {{ basename($att) }}
                                </a>

                                <button type="button" class="btn btn-sm btn-danger delete-attachment-btn"
                                    data-job-id="{{ $job->id }}" data-index="{{ $i }}">
                                    Удалить
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif


            </div>

            {{-- Описание --}}
            <div class="col-12">
                <label>Описание RU</label>
                <textarea name="description_ru" class="form-control" rows="4">{{ old('description_ru', $job->description_ru) }}</textarea>
            </div>
            <div class="col-12">
                <label>Описание TJ</label>
                <textarea name="description_tj" class="form-control" rows="4">{{ old('description_tj', $job->description_tj) }}</textarea>
            </div>
            <div class="col-12">
                <label>Описание EN</label>
                <textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $job->description_en) }}</textarea>
            </div>

            {{-- Локация, зарплата, даты, сорт --}}
            <div class="col-md-3">
                <label>Локация</label>
                <input name="location" class="form-control" value="{{ old('location', $job->location) }}">
            </div>
            <div class="col-md-3">
                <label>Зарплата</label>
                <input name="salary" class="form-control" value="{{ old('salary', $job->salary) }}">
            </div>
            <div class="col-md-3">
                <label>Дата начала</label>
                <input type="date" name="start_date" class="form-control"
                    value="{{ old('start_date', $job->start_date?->format('Y-m-d')) }}">
            </div>
            <div class="col-md-3">
                <label>Дата окончания</label>
                <input type="date" name="end_date" class="form-control"
                    value="{{ old('end_date', $job->end_date?->format('Y-m-d')) }}">
            </div>
            <div class="col-md-2">
                <label>Сорт</label>
                <input type="number" name="sort" class="form-control" value="{{ old('sort', $job->sort) }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input"
                        {{ $job->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">Активна</label>
                </div>
            </div>

            {{-- Кнопки --}}
            <div class="col-12 mt-3">
                <button class="btn btn-success">Сохранить</button>
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">Назад</a>
            </div>

        </div>
    </form>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    (function($) {
        $(function() {
            console.log('Скрипт удаления вложения инициализирован для задания с id: {{ $job->id }}');

            // Устанавливаем CSRF-заголовок на всякий случай
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // Делегированно ловим клики по любой кнопке с классом .delete-attachment-btn
            $(document).on('click', '.delete-attachment-btn', function(e) {
                e.preventDefault();

                // Отладка: покажем, что кнопка была нажата
                console.log('delete button clicked', this);

                if (!confirm('Удалить это вложение?')) return;

                const btn = $(this);
                const jobId = btn.data('job-id');
                const index = btn.data('index');
                const attachmentDiv = $('#attachment-' + index);

                // визуальное блокирование
                const originalHtml = btn.html();
                btn.prop('disabled', true).html('<span class="spinner"></span> Удаление...');

                // Проверим маршрут вручную: /jobs/{job}/delete-attachment
                const url = '/jobs/' + jobId + '/delete-attachment';
                console.log('AJAX POST to', url, 'index=', index);

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        index: index
                    },
                    timeout: 10000,
                    success: function(res) {
                        console.log('AJAX success', res);
                        if (res && res.success) {
                            // плавно удаляем
                            attachmentDiv.fadeOut(200, function() {
                                $(this).remove();
                            });

                            // обновим счётчик, если есть
                            const cnt = $('#attachment-count');
                            if (cnt.length && typeof res.newCount !== 'undefined') {
                                cnt.text(res.newCount);
                            }

                            // если нет вложений — напишем сообщение
                            if ($('#attachments-list').find('[id^="attachment-"]')
                                .length === 0) {
                                $('#attachments-list').html(
                                    '<p class="text-muted">Нет вложений</p>');
                            }

                            // оповещение
                            // Можно заменить alert на более красивый toast
                            alert(res.message || 'Удалено');
                        } else {
                            alert((res && res.message) ? res.message :
                                'Ошибка при удалении');
                            btn.prop('disabled', false).html(originalHtml);
                        }
                    },
                    error: function(xhr, status, err) {
                        console.error('AJAX error', status, err, xhr.responseText);
                        // Если 419 — CSRF/Session expired
                        if (xhr.status === 419) {
                            alert('Сессия истекла. Обнови страницу и попробуй снова.');
                        } else {
                            alert('Ошибка при удалении. Смотри консоль (F12).');
                        }
                        btn.prop('disabled', false).html(originalHtml);
                    }
                });
            });
        });
    })(jQuery);
</script>

<style>
    /* маленький спиннер */
    .spinner {
        display: inline-block;
        width: 14px;
        height: 14px;
        border: 2px solid #ccc;
        border-top-color: #333;
        border-radius: 50%;
        animation: spin .6s linear infinite;
        vertical-align: middle;
        margin-right: 6px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif

@endsection

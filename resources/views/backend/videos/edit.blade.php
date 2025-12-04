@extends('admin.admin_dashboard')
@section('heading', 'Редактировать видео')

@section('admin')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="d-flex justify-content-between mb-4">
                <h4 class="fw-bold">Редактировать видео</h4>
                <a href="{{ route('all.video') }}" class="btn btn-secondary">Назад</a>
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
            <form method="POST" action="{{ route('update.video', $video->id) }}" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="id" value="{{ $video->id }}">

                <div class="card mb-4">
                    <h5 class="card-header">Информация о видео</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title_ru" class="form-label">Название RU</label>
                                    <input type="text" id="title_ru" class="form-control" name="title_ru" value="{{ old('title_ru', $video->title_ru) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="title_tj" class="form-label">Название TJ</label>
                                    <input type="text" id="title_tj" class="form-control" name="title_tj" value="{{ old('title_tj', $video->title_tj) }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="title_en" class="form-label">Название EN</label>
                                    <input type="text" id="title_en" class="form-control" name="title_en" value="{{ old('title_en', $video->title_en) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="video_url" class="form-label">Адрес видео *</label>
                                    <input class="form-control" type="text" id="video_url" name="video_url" value="{{ old('video_url', $video->video_url) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="caption" class="form-label">Обложка видео *</label>
                                    <input class="form-control" type="file" id="caption" name="caption" accept="image/*">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Текущая обложка:</label><br>
                                    <img src="{{ asset($video->caption) }}" class="rounded img-thumbnail" alt="Video Cover" width="150">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Статус</label>
                                <select class="form-select" name="status" required>
                                    <option value="1" {{ old('status', $video->status) == 1 ? 'selected' : '' }}>Активный</option>
                                    <option value="0" {{ old('status', $video->status) == 0 ? 'selected' : '' }}>Неактивный</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Позиция</label>
                                    <input class="form-control" type="number" id="position" name="position" min="0" value="{{ old('position', $video->position) }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-success">Обновить</button>
                </div>
            </form>

        </div>
    </div>

@endsection

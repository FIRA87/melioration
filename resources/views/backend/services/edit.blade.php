@extends('admin.admin_dashboard')
@section('heading', 'Service Create')

@section('admin')

@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Редактировать</span> </h4>
            </div>
            <div>
                <h5><a href="{{ route('all.services') }}" class="btn btn-danger">Назад </a></h5>
            </div>
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
        <form method="POST" action="{{ route('update.services') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $service->id }}">

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Услуга</h5>

                        <hr class="my-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3 ">
                                        <label for="title_ru" class="form-label">Название RU</label>
                                        <input type="text" id="title_ru" class="form-control" name="title_ru"
                                            value="{{ old('title_ru', $service->title_ru) }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3 ">
                                        <label for="title_tj" class="form-label">Название TJ</label>
                                        <input type="text" id="title_tj" class="form-control" name="title_tj"
                                               value="{{ old('title_tj', $service->title_tj) }}">
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="title_en" class="form-label">Название EN</label>
                                        <input type="text" id="title_en" class="form-control" name="title_en"
                                               value="{{ old('title_en', $service->title_en) }}">
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-3 ">
                                        <label for="sort" class="form-label">Позиция</label>
                                        <input class="form-control" type="text" id="sort" name="sort" autofocus="" value="{{ old('sort', $service->sort) }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3 ">
                                        <label for="icon" class="form-label">Иконка</label>
                                        <input class="form-control" type="text" id="icon" name="icon" autofocus="" value="{{ old('icon', $service->icon) }}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="slug" class="form-label">Slug (URL) <span class="text-danger">*</span></label>
                                        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $service->slug) }}" >
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group mb-4 d-flex align-items-center" style="gap: 12px;">
                                        <label class="form-label mb-0 fw-semibold" style="font-size: 15px; margin-right: 35px;">Статус:</label>

                                        <div class="d-flex align-items-center" style="gap: 8px;">
                                            <div class="form-check form-switch m-0 p-0">
                                                <input type="checkbox"
                                                       class="form-check-input"
                                                       id="statusCheckbox"
                                                       name="status"
                                                       value="1"
                                                       {{ old('status', $service->status) == 1 ? 'checked' : '' }}
                                                       style="width: 2.5rem; height: 1.3rem; cursor: pointer;">
                                            </div>

                                            <span id="status-label" class="{{ $service->status == 1 ? 'text-success fw-bold' : 'text-muted' }}" style="font-size: 15px;">
            {{ $service->status == 1 ? 'Активный' : 'Неактивный' }}
        </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <ul class="nav nav-tabs nav-bordered" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a href="#text_ru" data-bs-toggle="tab" aria-expanded="false"
                                                   class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                                                    ТЕКСТ [RU]
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#text_tj" data-bs-toggle="tab" aria-expanded="true"
                                                   class="nav-link active" aria-selected="true" role="tab">
                                                    ТЕКСТ [TJ]
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#text_en" data-bs-toggle="tab" aria-expanded="false"
                                                   class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                                                    ТЕКСТ [EN]
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="text_ru" role="tabpanel">
                                                <textarea name="text_ru" id="summernote" cols="107" rows="10" class="form-control my-editor">{!! old('text_ru', $service->text_ru) !!}</textarea>
                                            </div>
                                            <div class="tab-pane show active" id="text_tj" role="tabpanel">
                                                <textarea name="text_tj" id="summernote2" cols="107" rows="10" class="form-control my-editor">{!! old('text_tj', $service->text_tj) !!}</textarea>
                                            </div>
                                            <div class="tab-pane" id="text_en" role="tabpanel">
                                                <textarea name="text_en" id="summernote3" cols="107" rows="10" class="form-control my-editor">{!! old('text_en', $service->text_en) !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Обновить</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('statusCheckbox');
        const label = document.getElementById('status-label');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                label.textContent = 'Активный';
                label.classList.remove('text-muted');
                label.classList.add('text-success', 'fw-bold');
            } else {
                label.textContent = 'Неактивный';
                label.classList.remove('text-success', 'fw-bold');
                label.classList.add('text-muted');
            }
        });
    });
</script>

@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif
@endsection

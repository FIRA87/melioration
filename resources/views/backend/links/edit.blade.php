@extends('admin.admin_dashboard')
@section('heading', 'Link Create')

@section('admin')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Редактировать ссылки</span> </h4>
                </div>
                <div>
                    <h5><a href="{{ route('all.links') }}">Back </a></h5>
                </div>
            </div>


{{--            <form method="POST" action="{{ route('update.links') }}" enctype="multipart/form-data">--}}
            <form method="POST" action="{{ route('update.links', $link->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- ОБЯЗАТЕЛЬНО для update через POST -->


                <input type="hidden" name="id" value="{{ $link->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Ссылка</h5>

                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 ">
                                            <label for="title_ru" class="form-label">Название RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru"
                                                value="{{ $link->title_ru }}">
                                        </div>

                                        <div class="form-group mb-3 ">
                                            <label for="title_tj" class="form-label">Название TJ</label>
                                            <input type="text" id="title_tj" class="form-control" name="title_tj"
                                                value="{{ $link->title_tj }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Название EN</label>
                                            <input type="text" id="title_en" class="form-control" name="title_en"
                                                value="{{ $link->title_en }}">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="url" class="form-label">Адрес ссылки *</label>
                                            <input class="form-control" type="text" id="url" name="url"
                                                autofocus="" value="{{ $link->url }}">
                                        </div>

                                        <div class="mb-3 ">
                                            <label for="img" class="form-label">Изображение *</label>
                                            <input class="form-control" type="file" id="img" name="img"
                                                autofocus="" value="{{ $link->img }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="showImage" class="form-label"></label>
                                            <img src="{{ asset($link->img) }}"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image"
                                                id="showImage">
                                        </div>

                                    </div>
                                    <div class="col-md-6 form-group mb-3">

                                        <label for="status" class="form-label">Статус</label>
                                        <select class="form-select" name="status" aria-invalid="false">
                                            <option value="1" @if ($link->status == '1') selected @endif>
                                                Активный</option>
                                            <option value="0" @if ($link->status == '0') selected @endif>
                                                Неактивный</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 ">
                                            <label for="sort" class="form-label">Позиция</label>
                                            <input class="form-control" type="text" id="sort" name="sort"
                                                autofocus="" value="{{ $link->sort }}">
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


@endsection

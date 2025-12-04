@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="content">
        <div class="container-fluid">

            <!-- Заголовок страницы -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('all.admin') }}">Назад</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Обновление настройки</h4>
                    </div>
                </div>
            </div>

            <!-- Форма -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                           <form id="myForm" method="POST" action="{{ route('setting.update') }}" enctype="multipart/form-data">
                                    @csrf
                                <input type="hidden" name="id" value="{{ $settings->id }}">

                                <div class="row">

                                    <!-- Адреса -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="street_ru" class="form-label">Адрес [RU]</label>
                                            <input type="text" id="street_ru" class="form-control" name="street_ru"
                                                   value="{{ old('street_ru', $settings->street_ru) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="street_tj" class="form-label">Адрес [TJ]</label>
                                            <input type="text" id="street_tj" class="form-control" name="street_tj"
                                                   value="{{ old('street_tj', $settings->street_tj) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="street_en" class="form-label">Адрес [EN]</label>
                                            <input type="text" id="street_en" class="form-control" name="street_en"
                                                   value="{{ old('street_en', $settings->street_en) }}">
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="title_ru" class="form-label">Заголовок [RU]</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru"
                                                   value="{{ old('title_ru', $settings->title_ru) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="title_tj" class="form-label">Заголовок [TJ]</label>
                                            <input type="text" id="title_tj" class="form-control" name="title_tj"
                                                   value="{{ old('title_tj', $settings->title_tj) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Заголовок [EN]</label>
                                            <input type="text" id="title_en" class="form-control" name="title_en"
                                                   value="{{ old('title_en', $settings->title_en) }}">
                                        </div>
                                    </div>




                                    <!-- Контакты -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="phone" class="form-label">Телефон</label>
                                            <input type="text" id="phone" class="form-control" name="phone"
                                                   value="{{ old('phone', $settings->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" id="email" class="form-control" name="email"
                                                   value="{{ old('email', $settings->email) }}">
                                        </div>
                                    </div>

                                    <!-- Соцсети -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="facebook" class="form-label">Facebook</label>
                                            <input type="text" id="facebook" class="form-control" name="facebook"
                                                   value="{{ old('facebook', $settings->facebook) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="twitter" class="form-label">Twitter</label>
                                            <input type="text" id="twitter" class="form-control" name="twitter"
                                                   value="{{ old('twitter', $settings->twitter) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="telegram" class="form-label">Telegram</label>
                                            <input type="text" id="telegram" class="form-control" name="telegram"
                                                   value="{{ old('telegram', $settings->telegram) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input type="text" id="instagram" class="form-control" name="instagram"
                                                   value="{{ old('instagram', $settings->instagram) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="youtube" class="form-label">Youtube</label>
                                            <input type="text" id="youtube" class="form-control" name="youtube"
                                                   value="{{ old('youtube', $settings->youtube) }}">
                                        </div>
                                    </div>

                                    <!-- Логотип компании -->


                                    <!-- Контактная информация -->
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="contact_title" class="form-label">Название контакта</label>
                                            <input type="text" id="contact_title" class="form-control"
                                                   name="contact_title" value="{{ old('contact_title', $settings->contact_title) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="contact_detail" class="form-label">Контактные данные</label>
                                            <input type="text" id="contact_detail" class="form-control"
                                                   name="contact_detail" value="{{ old('contact_detail', $settings->contact_detail) }}">
                                        </div>
                                    </div>

                                    <!-- Карта -->
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label for="contact_map" class="form-label">Карта контактов (iframe)</label>
                                            <textarea name="contact_map" id="contact_map" class="form-control"
                                                      rows="10">{{ old('contact_map', $settings->contact_map) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Логотип компании</label><br>
                                            @if($settings->logo)
                                                <img id="previewImage" src="{{ asset($settings->logo) }}" alt="logo"
                                                     width="120" class="mb-2 rounded border">
                                            @else
                                                <img id="previewImage" src="{{ asset('upload/no-image.jpg') }}" alt="logo"
                                                     width="120" class="mb-2 rounded border">
                                            @endif
                                            <input type="file" name="logo" class="form-control" id="logoInput">
                                        </div>
                                    </div>

                                    <!-- Кнопка -->
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                            <i class="mdi mdi-content-save"></i> Обновить
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Предпросмотр логотипа -->
    <script>
        $(document).ready(function() {
            $('#logoInput').change(function(e) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

@endsection

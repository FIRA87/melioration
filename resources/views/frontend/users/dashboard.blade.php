@extends('frontend.master')
@section('content')

    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">
                    Панель инструментов
                </h1>
            </div>
        </div>
    </div>


    <div class="container mt-5 mb-5">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">

                                <img src="{{ ( !empty($userData->photo)) ? url('upload/images/users/'.$userData->photo): url('upload/no-image.jpg') }}" class="rounded-circle p-1 bg-primary"  width="110" alt="profile-image">
                                <div class="mt-3">
                                    <h4>{{ $userData->username }}</h4>
                                    <p class="text-secondary mb-1"><b>Логин</b> : {{ $userData->name }}</p>
                                    <p class="text-muted font-size-sm"><b>Телефон</b> : {{ $userData->phone }}</p>

                                  <p><a href="{{ route('change.password') }}" style="color: #0a53be">Изменить пароль</a>
                                    <p>  <a href="{{ route('user.logout') }}" style="color: #0a53be">Выйти</a></p>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                    <div class="col-lg-8">
                        <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf

                            @if(session('status'))
                                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                            @endif


                    <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">ФИО</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{ $userData->username }}" style="color: #0a0a0a" name="username">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">E-mail</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{ $userData->email }}" style="color: #0a0a0a" name="email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Телефон</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{ $userData->phone }}" style="color: #0a0a0a" name="phone">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Изображение</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control" name="photo" id="photo">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Сохранить">
                                    </div>
                                </div>
                            </div>
                        </div>
                  </form>

            </div>
        </div>
    </div>
    </div>
    <style>
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }
        .me-2 {
            margin-right: .5rem!important;
        }

    </style>
@endsection

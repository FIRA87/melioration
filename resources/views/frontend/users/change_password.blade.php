@extends('frontend.master')
@section('content')

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
                                    <p class="text-secondary mb-1">{{ $userData->name }}</p>
                                    <p class="text-muted font-size-sm">{{ $userData->phone }}</p>

                                    <p><a href="{{ route('change.password') }}" style="color: #0a53be">Изменить пароль</a>
                                    <p>  <a href="{{ route('user.logout') }}" style="color: #0a53be">Выйти</a></p>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="col-lg-8">
                    <form method="post" action="{{ route('user.change.password') }}" enctype="multipart/form-data">
                        @csrf

                        @if(session('status'))
                            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                        @endif


                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Old Password</label>
                                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="current_password"  >
                                            @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"  name="new_password"  >
                                            @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="new_password_confirmation"  name="new_password_confirmation"  >
                                            @error('new_password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Change Password">
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

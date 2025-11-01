@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Пользователи</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Администратор</a></li>
                            <li class="breadcrumb-item active">Изменить</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Изменить пароль</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update.password') }}">
                            @csrf

                            @if(session('status'))
                                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                            @endif
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Изменить пароль администратора</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Старый пароль</label>
                                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="current_password"  >
                                            @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Новый пароль</label>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"  name="new_password"  >
                                        @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Подтвердите пароль</label>
                                        <input type="password" class="form-control" id="new_password_confirmation"  name="new_password_confirmation"  >
                                        @error('new_password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Изменить пароль</button>
                            </div>
                        </form>
                        <!-- end settings content-->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->
    </div> <!-- container -->
@endsection

@extends('admin.admin_dashboard')
@section('admin')

@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
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
                        <li class="breadcrumb-item"><a href="{{ route('all.admin') }}">Назад</a></li>

                    </ol>
                </div>
                <h4 class="page-title">Пользователь</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Добавить пользователя</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="myForm" method="POST" action="{{ route('store.admin') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">ФИО</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
                                </div>

                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Телефон</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>

                        </div> <!-- end col -->

                        <div class="col-lg-6">

                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Имя пользователя</label>
                                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
                            </div>


                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"  name="password"  >
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                         <div class="form-group mb-3">
                                <label for="password" class="form-label">Роль</label>
                                <select class="form-select" id="group_name" name="roles">
                                    <option value="choose-category">Выберите одну роль</option>
                                    @foreach($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>




                        </div> <!-- end col -->

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Сохранить</button>
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
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    name: {
                        required : true,
                    },

                    username: {
                        required : true,
                    },

                    email: {
                        required : true,
                    },

                    phone: {
                        required : true,
                    },

                    password: {
                        required : true,
                    },

                },
                messages :{
                    name: {
                        required : 'Пожалуйста, введите Ваше ФИО ',
                    },
                    username: {
                        required : 'Пожалуйста, введите Ваше имя пользователя',
                    },
                    email: {
                        required : 'Пожалуйста, введите свой E-mail',
                    },
                    phone: {
                        required : 'Пожалуйста введите Ваш номер телефона',
                    },

                    password: {
                        required : 'Пожалуйста введите Ваш пароль',
                    },

                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
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

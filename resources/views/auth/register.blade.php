@extends('frontend.master')
@section('content')


    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">
                    Зарегистрироваться
                </h1>
            </div>
        </div>
    </div>


  <div class="container-fluid">
        <div class="">
            <div class="rounded d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                    <div class="text-center">
                        <h3 class="text-primary">Зарегистрироваться</h3>
                    </div>
                    <div class="p-4">
                        <form method="POST" action="{{ route('register') }}" >
                            @csrf
                            <div class="input-group mb-3">
                                    <span class="input-group-text" style="background: linear-gradient(90deg,#01b4ee,#28348a);"><i class="bi bi-person-plus-fill text-white"></i></span>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control"  placeholder="name" style="color: #0a0a0a"></span>
                            </div>
                            <div class="input-group mb-3">
                                    <span class="input-group-text " style="background: linear-gradient(90deg,#01b4ee,#28348a);"><i class="bi bi-envelope text-white"></i></span>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control"  placeholder="Email" ></span>
                            </div>
                            <div class="input-group mb-3">
                                    <span class="input-group-text " style="background: linear-gradient(90deg,#01b4ee,#28348a);"><i class="bi bi-key-fill text-white"></i></span>
                                <input type="password"  name="password"  class="form-control" placeholder="Password" ></span>
                            </div>

                            <div class="input-group mb-3">
                                    <span class="input-group-text" style="background: linear-gradient(90deg,#01b4ee,#28348a);"><i class="bi bi-key-fill text-white"></i></span>
                                <input type="password"  name="password_confirmation"  class="form-control"  placeholder="confirm password"></span>
                            </div>


                            <div class="d-grid col-12 mx-auto">
                                <button class="btn btn-primary"><span></span> Зарегистрироваться</button>
                            </div>
                            <p class="text-center mt-3">У вас уже есть аккаунт?
                                <a href="{{ url('login') }}"> <span class="text-primary">Войти</span></a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

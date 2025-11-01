@extends('frontend.master')
@section('content')

   <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">
                    Login
                </h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-offset-5 col-md-3 mt-5 mb-5">
                <div class="form-login">
                    <h4>Login</h4>
                    <form method="POST" action="{{ route('login') }}" class="init"  novalidate="novalidate" data-status="init">
                        @csrf
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                        @endif
                            <input type="text" id="email" class="form-control input-sm chat-input" placeholder="email"  name="email"/>
                            </br>
                            <input type="password" id="userPassword" class="form-control input-sm chat-input" placeholder="password" name="password" />
                            </br>
                            <div class="wrapper">
                        <span class="group-btn">
                            <button class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
                        </span>
                      </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <style>


        .form-login {
            background-color: #EDEDED;
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            border-radius: 15px;
            border-color:#d2d2d2;
            border-width: 5px;
            box-shadow:0 1px 0 #cfcfcf;
        }

        h4 {
            border:0 solid #fff;
            border-bottom-width:1px;
            padding-bottom:10px;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
        }

        .wrapper {
            text-align: center;
        }
    </style>





@endsection

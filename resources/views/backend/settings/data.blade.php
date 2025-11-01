@extends('admin.admin_dashboard')
@section('admin')


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
                        <h4 class="page-title">ОБНОВЛЕНИЕ НАСТРОЙКИ</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="POST" action="{{ route('update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $settings->id }}">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="street_ru" class="form-label">Адрес [RU]</label>
                                            <input type="text" id="street_ru" class="form-control" name="street_ru" value="{{ $settings->street_ru }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="street_tj" class="form-label">Адрес [TJ]</label>
                                            <input type="text" id="street_tj" class="form-control" name="street_tj" value="{{ $settings->street_tj }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="street_en" class="form-label">Адрес [EN]</label>
                                            <input type="text" id="street_en" class="form-control" name="street_en" value="{{ $settings->street_en }}">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="phone" class="form-label">Тел</label>
                                            <input type="text" id="phone" class="form-control" name="phone" value="{{ $settings->phone }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" id="email" class="form-control" name="email" value="{{ $settings->email }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="facebook" class="form-label">Facebook</label>
                                            <input type="text" id="facebook" class="form-control" name="facebook" value="{{ $settings->facebook }}">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="twitter" class="form-label">Twitter</label>
                                            <input type="text" id="twitter" class="form-control" name="twitter" value="{{ $settings->twitter }}">
                                        </div>
                                    </div> <!-- end col -->


                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="telegram" class="form-label">Telegram</label>
                                            <input type="text" id="telegram" class="form-control" name="telegram" value="{{ $settings->telegram }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input type="text" id="instagram" class="form-control" name="instagram" value="{{ $settings->instagram }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="youtube" class="form-label">Youtube</label>
                                            <input type="text" id="youtube" class="form-control" name="youtube" value="{{ $settings->youtube }}">
                                        </div>
                                    </div> <!-- end col -->


                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="contact_title" class="form-label">Название контакта</label>
                                            <input type="text" id="contact_title" class="form-control" name="contact_title" value="{{ $settings->contact_title }}">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="contact_detail" class="form-label">Контактные данные</label>
                                            <input type="text" id="contact_detail" class="form-control" name="contact_detail" value="{{ $settings->contact_detail }}">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label for="contact_map" class="form-label">Карта контактов (код IFrame)</label>
                                             <textarea name="contact_map" id="contact_map" cols="107" rows="10"> {{ $settings->contact_map }}</textarea>
                                        </div>
                                    </div> <!-- end col -->

                                    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Обновить</button>
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



                },
                messages :{
                    name: {
                        required : 'Пожалуйста, введите Ваше имя ',
                    },
                    username: {
                        required : 'Пожалуйста, введите Ваш логин',
                    },
                    email: {
                        required : 'Пожалуйста, введите ваш Email',
                    },
                    phone: {
                        required : 'Пожалуйста введите ваш номер телефона',
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



@endsection

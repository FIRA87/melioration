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
                        <li class="breadcrumb-item"><a href="{{ route('all.category') }}">Назад</a></li>

                    </ol>
                </div>
                <h4 class="page-title">Категория</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-white">Добавить </h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="myForm" method="POST" action="{{ route('store.category') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="title_ru" class="form-label">Название RU</label>
                                    <input type="text" id="title_ru" class="form-control" name="title_ru" value="{{ old('title_ru') }}">
                                </div>  
                            </div> <!-- end col -->

                            <div class="col-md-4"> 
                                <div class="form-group mb-3">
                                    <label for="title_tj" class="form-label">Название TJ</label>
                                    <input type="text" id="title_tj" name="title_tj" class="form-control" value="{{ old('title_tj') }}">
                                </div>
                            </div>

                            <div class="col-md-4">                                
                                <div class="form-group mb-3">
                                    <label for="title_en" class="form-label">Название EN</label>
                                    <input type="text" id="title_en" name="title_en" class="form-control" value="{{ old('title_en') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="position" class="form-label">Позиция</label>
                                    <input type="text" id="position" name="position" class="form-control" value="{{ old('position') }}">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="status" class="form-label">Статус <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status">
                                        <option value="1"> Активный</option>
                                        <option value="0"> Неактивный</option>
                                    </select>
                                </div>
                            </div> <!-- end col -->

                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                    <i class="mdi mdi-content-save"></i>Сохранить</button>
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
$(document).ready(function() {

    $('#myForm').validate({
        rules: {
            title_ru: {
                required: true,
            },
            title_tj: {
                required: true,
            },
            title_en: {
                required: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            title_ru: {
                required: 'Пожалуйста, введите название категории RU',
            },
            title_tj: {
                required: 'Пожалуйста, введите название категории TJ',
            },
            title_en: {
                required: 'Пожалуйста, введите название категории EN',
            },
            status: {
                required: 'Пожалуйста, выберите статус категории',
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
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

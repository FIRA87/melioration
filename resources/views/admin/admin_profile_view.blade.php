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
                            <li class="breadcrumb-item active">Вид</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Администратор</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ ( !empty($adminData->photo)) ? url('upload/images/admin/'.$adminData->photo): url('upload/no-image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail"   alt="profile-image">

                        <h4 class="mb-0">{{ $adminData->name }}</h4>
                        <p class="text-muted">{{ $adminData->username }}</p>

                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Полное имя :</strong> <span class="ms-2">{{ $adminData->name }}</span></p>
                            <p class="text-muted mb-2 font-13"><strong>Мобильный телефон :</strong><span class="ms-2">{{ $adminData->phone }}</span></p>
                            <p class="text-muted mb-2 font-13"><strong>E-mail :</strong> <span class="ms-2">{{ $adminData->email }}</span></p>
                            <p class="text-muted mb-1 font-13"><strong>Местоположение :</strong> <span class="ms-2">Таджикистан</span></p>
                        </div>

                    </div>
                </div> <!-- end card -->



            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Личная информация</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">ФИО</label>
                                                <input type="text" class="form-control" id="firstname"  name="username" value="{{ $adminData->username }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Логин</label>
                                                <input type="text" class="form-control" id="name"  name="name"  value="{{ $adminData->name }}">
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="text" class="form-control" id="email"  name="email" value="{{ $adminData->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Телефон</label>
                                        <input type="text" class="form-control" id="phone"  name="phone"  value="{{ $adminData->phone }}">
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <label for="image" class="form-label">Загрузить фото</label>
                                    <input type="file"  class="form-control" name="photo" id="image">
                                </div>

                                <div class="col-md-6">
                                    <label for="showImage" class="form-label">Существующее фото</label>
                                    <img src="{{ ( !empty($adminData->photo)) ? url('upload/images/admin/'.$adminData->photo): url('upload/no-image.jpg') }}"
                                         class="rounded-circle avatar-lg img-thumbnail"
                                         alt="profile-image"
                                         id="showImage"
                                    >
                                </div>


                            </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Сохранить</button>
                                    </div>
                                </form>

                            <!-- end settings content-->


                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->


<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
           let reader = new FileReader();
           reader.onload = function(e) {
               $('#showImage').attr('src', e.target.result);
           }
           reader.readAsDataURL(e.target.files['0'])
        })
    });
</script>

@endsection

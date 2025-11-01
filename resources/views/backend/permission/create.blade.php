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
                                <li class="breadcrumb-item"><a href="{{ route('all.permission') }}">Назад</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Добавить разрешение</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="POST" action="{{ route('store.permission') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="position" class="form-label">Наименование разрешения</label>
                                            <input type="text" id="position" name="name" class="form-control" placeholder="Add Permission">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Группа</label>
                                            <select class="form-select" name="group_name">
                                                <option value="choose-category">Выберите группу</option>
                                                <option value="category">Категория </option>
                                                <option value="subcategory">Подкатегория </option>
                                                <option value="gallery">Галерея </option>
                                                <option value="image">Изображение </option>
                                                <option value="banner">Баннер </option>
                                                <option value="newsPost">Новости </option>
                                                <option value="seo">Seo </option>
                                                <option value="setting">Настройка </option>
                                                <option value="video">Видео </option>
                                                <option value="review">Отзыв </option>
                                                <option value="role">Роль и разрешение </option>
                                                <option value="admin">Администратор </option>

                                            </select>
                                        </div>
                                    </div>

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

@endsection

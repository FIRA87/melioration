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
                        <h4 class="page-title">Изменить разрешение</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="POST" action="{{ route('update.permission') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $permission->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="position" class="form-label">Наименование разрешения</label>
                                            <input type="text" id="position" name="name" class="form-control" value="{{ $permission->name }}">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class=" form-group mb-3">
                                            <label for="group_name" class="form-label">Группа</label>
                                            <select class="form-select" id="group_name" name="group_name">
                                                <option value="choose-category">Выберите группу</option>
                                                <option value="category" {{ $permission->group_name == 'category' ? 'selected' : '' }}>Категория </option>
                                                <option value="subcategory"  {{ $permission->group_name == 'subcategory' ? 'selected' : '' }}>Подкатегория </option>
                                                <option value="gallery"  {{ $permission->group_name == 'gallery' ? 'selected' : '' }}>Галерея </option>
                                                <option value="image"  {{ $permission->group_name == 'image' ? 'selected' : '' }}>Изображение </option>
                                                <option value="banner"  {{ $permission->group_name == 'banner' ? 'selected' : '' }}>Баннер </option>
                                                <option value="newsPost"  {{ $permission->group_name == 'newsPost' ? 'selected' : '' }}>Новости </option>
                                                <option value="seo"  {{ $permission->group_name == 'seo' ? 'selected' : '' }}>Seo</option>
                                                <option value="setting"  {{ $permission->group_name == 'setting' ? 'selected' : '' }}>Настройка</option>
                                                <option value="video"  {{ $permission->group_name == 'video' ? 'selected' : '' }}>видео </option>
                                                <option value="review"  {{ $permission->group_name == 'review' ? 'selected' : '' }}>Отзыв </option>
                                                <option value="role"  {{ $permission->group_name == 'roles' ? 'selected' : '' }}>Роль и разрешение </option>
                                                <option value="admin"  {{ $permission->group_name == 'admin' ? 'selected' : '' }}>Администратор </option>
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

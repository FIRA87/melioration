@extends('admin.admin_dashboard')
@section('admin')
    @php
      
    @endphp

    <div class="content">
        @if ($user && $status == 'active')
            <h4>Учетная запись администратора - <span class="text-success">Активен</span></h4>
        @else
            <h4>Учетная запись администратора <span class="text-danger">Неактивен</span></h4>
            <p class="text-danger"><b>Пожалуйста, подождите, администратор проверит и утвердит вашу учетную запись</b></p>
        @endif
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Панель управления</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                                        <i class="mdi mdi-newspaper font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $news->count() }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Все новости</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                                        <i class="mdi mdi-checkbox-marked font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup"> {{  $activeNews }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Активные новости</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                        <i class="mdi mdi-folder-multiple-image font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{  $activeSliderNews  }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Слайдер</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                                        <i class="mdi mdi-account-multiple font-22  avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $users->count() }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate" style="overflow: visible">Польватели </p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Последние новости</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Заголовок</th>
                                          
                                            <th>Картинка</th>
                                            <th>Дата </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($news->take(3) as $item)
                                        <tr>
                                        <td><h5 class="m-0 fw-normal"> {{ $item->id }}</h5>     </td>
                                        <td>  {{ $item->title_ru }}   </td>
                                        <td> <img src="{{ asset($item->image) }}" class="rounded-circle avatar-lg img-thumbnail"   alt="profile-image" style="height: 100px; width: 100px;"> </td>
                                        <td> {{ $item->publish_date }}</td>
                                     
                                      
    
                                    </tr>
                                @endforeach


                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive-->
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
@endsection

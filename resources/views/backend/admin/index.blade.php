@extends('admin.admin_dashboard')
@section('admin')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('add.admin') }}" class="btn btn-blue waves-effect waves-light text-white">
                                    Добавить
                                </a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Все пользователи<span class="btn btn-danger"> {{ count($allAdminUsers) }}</span> </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Изображение</th>
                                <th>ФИО</th>
                                <th>E-mail</th>
                                <th>Телефон</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($allAdminUsers as $key=> $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ ( !empty($item->photo)) ? url('upload/images/admin/'.$item->photo): url('upload/no-image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail"   alt="profile-image" style="height: 100px; width: 100px;">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td> {{ $item->phone }}</td>
                                    <td>
                                        @if($item->status == 'active')
                                            <span class="btn btn-success rounded-pill waves-effect waves-light">Активный</span>
                                        @else
                                            <span class="btn btn-danger waves-effect waves-light">Неактивный</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.admin', $item->id) }}" class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>   </a>
                                        <a href="{{ route('delete.admin', $item->id) }}" class="btn btn-danger waves-effect waves-light" id="delete"> <i class="fa-solid fa-trash"></i>  </a>

                                        @if($item->status == 'active')
                                            <a href="{{ route('inactive.admin.user', $item->id) }}" class="btn  waves-effect waves-light" title="InActive">
                                                <span class="switchery switchery-default" style="background-color: rgb(27, 185, 154); border-color: rgb(27, 185, 154); box-shadow: rgb(27, 185, 154) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 20px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s; background-color: rgb(255, 255, 255);"></small></span>

                                            </a>
                                        @else
                                            <a href="{{ route('active.admin.user', $item->id) }}" class="btn  waves-effect waves-light" title="Active">
                                                <span class="switchery switchery-default" style="background-color: rgb(152, 166, 173); border-color: rgb(152, 166, 173); box-shadow: rgb(152, 166, 173) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                            </a>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->




@endsection

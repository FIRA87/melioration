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
                                <li class="breadcrumb-item"><a href="{{ route('add.roles') }}" class="btn btn-blue waves-effect waves-light text-white">Добавить </a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Роли пользователей</h4>
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
                                    <th>Наименование роли</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($roles as $item)
                                    <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->name }} </td>
                                        <td>
                                            <a href="{{ route('edit.roles', $item->id) }}" class="btn btn-primary waves-effect waves-light">Изменить</a>
                                            <a href="{{ route('delete.roles', $item->id) }}" class="btn btn-danger waves-effect waves-light" id="delete">Удалить</a>
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

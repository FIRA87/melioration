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
                                <li class="breadcrumb-item"><a href="{{ route('add.roles') }}" class="btn btn-blue waves-effect waves-light">Добавить разрешение для роли</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Все роли с разрешениями</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Разрешение на все роли</h4>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="10%">Имя роли</th>
                                    <th>Название разрешения</th>
                                    <th width="10%">Действие</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($roles as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }} </td>
                                        <td>

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.edit.roles', $item->id) }}" class="btn btn-primary waves-effect waves-light">Редактировать</a>
                                            <a href="{{ route('admin.delete.roles', $item->id) }}" class="btn btn-danger waves-effect waves-light" id="delete">Удалить</a>
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

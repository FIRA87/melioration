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
                                <li class="breadcrumb-item"><a href="{{ route('add.category') }}"
                                        class="btn btn-blue waves-effect waves-light text-white">Добавить </a></li>

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

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название RU</th>
                                        <th>Название TJ</th>
                                        <th>Название EN</th>
                                        <th>Сортировка</th>
                                        <th>Дата</th>
                                        <th>Статус</th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($categories as $key => $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title_ru }} </td>
                                            <td>{{ $item->title_tj }}</td>
                                            <td>{{ $item->title_en }}</td>
                                            <td> {{ $item->position }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge bg-success">Активный</span>
                                                @else
                                                    <span class="badge bg-danger">Неактивный</span>
                                                @endif
                                            </td>
                                            <td>

                                                <a href="{{ route('edit.category', $item->id) }}"
                                                    class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>   </a>
                                                <a href="{{ route('delete.category', $item->id) }}"
                                                    class="btn btn-danger waves-effect waves-light"
                                                    id="delete"> <i class="fa-solid fa-trash"></i>  </a>
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

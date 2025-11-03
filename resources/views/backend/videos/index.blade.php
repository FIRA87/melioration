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
                                <li class="breadcrumb-item"><a href="{{ route('add.video') }}" class="btn btn-blue waves-effect waves-light text-white">Добавить</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Видео</h4>
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
                                    <th>Обложка видео</th>
                                    <th>Дата</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($videos as $item)
                                <tr>
                                    <td>{{ $item->id}}</td>
                                    <td title="{{ $item->title_ru }}"> {{ \Illuminate\Support\Str::limit( $item->title_ru, 50)  }} </td>
                                    <td> <img src="{{ asset($item->caption) }}" alt="" class="img-fluid" style="max-height: 100px; ">   </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('edit.video', $item->id) }}" class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>  </a>
                                        <a href="{{ route('delete.video', $item->id) }}" class="btn btn-danger waves-effect waves-light" id="delete"> <i class="fa-solid fa-trash"></i></a>
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

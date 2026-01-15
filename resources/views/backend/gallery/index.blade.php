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
                        @if(Auth::user()->can('gallery.add'))
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('add.gallery') }}" class="btn btn-blue waves-effect waves-light text-white">Добавить </a></li>
                        </ol>
                        @endif
                    </div>
                    <h4 class="page-title">Галереи</h4>
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
                                <th>Обложка галереи</th>
                                <th>Дата</th>
                                <th>Действие</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($galleries as $item)
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td title="{{ $item->title_ru }}"> {{ $item->title_ru  }} </td>
                                <td>
                                    <img src="upload/cover/{{ $item->cover }}" alt="" class="img-fluid" style="max-height: 100px;">
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>

                                    @if(Auth::user()->can('gallery.edit'))
                                    <a href="{{ route('edit.gallery', $item->id) }}" class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>   </a>
                                     @endif
                                    @if(Auth::user()->can('video.delete'))
                                    <a href="{{ route('delete.gallery', $item->id) }}" class="btn btn-danger waves-effect waves-light" id="delete"> <i class="fa-solid fa-trash"></i> </a>
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

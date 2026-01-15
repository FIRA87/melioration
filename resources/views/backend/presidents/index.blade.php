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
                         @if(Auth::user()->can('presidents.add'))
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('add.presidents') }}" class="btn btn-blue waves-effect waves-light text-white">Добавить </a></li>
                        </ol>
                        @endif
                    </div>
                    <h4 class="page-title">Президент</h4>
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
                                <th>Адрес (URL)</th>
                                <th>Изображение</th>
                                <th>Статус</th>
                                <th>Сортировка</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($presidents as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title_ru }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->title_tj }}" style=" height: 100px; object-fit: cover;">
                                    @else
                                        Нет изображения
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge bg-success">Активен</span>
                                    @else
                                        <span class="badge bg-danger">Неактивен</span>
                                    @endif
                                </td>
                                <td>{{ $item->sort }}</td>
                                <td>
                                     @if(Auth::user()->can('presidents.edit'))
                                        <a href="{{ route('edit.presidents', $item->id) }}" class="btn btn-primary waves-effect waves-light">
                                            <i class="fa-solid fa-pen"></i>  
                                        </a>
                                    @endif

                                     @if(Auth::user()->can('presidents.delete'))
                                        <a href="{{ route('delete.presidents', $item->id) }}" class="btn btn-danger waves-effect waves-light" id="delete">  
                                            <i class="fa-solid fa-trash"></i> 
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


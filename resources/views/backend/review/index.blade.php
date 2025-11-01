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

                        </div>
                        <h4 class="page-title">Комментарии</h4>
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
                                    <th>Новость</th>
                                    <th>Пользователь</th>
                                    <th>Обложка новости</th>
                                    <th>Статус</th>
                                    <th>Дата</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($review as $item)
                                <tr>
                                    <td>{{ $item->id}}</td>
                                    <td title="{{ $item->news->title_ru }}">{{ Str::limit($item->news->title_ru, 50)  }}</td>
                                    <td>  {{ $item->user->name ?? 'Гость'}}  </td>
                                    <td> <img src="{{ asset($item->news->image) }}" alt="" width="100">   </td>
                                    <td>
                                        @if($item->status == 0)
                                            <span class="btn btn-danger rounded-pill waves-effect waves-light">В ожидании</span>
                                        @else
                                            <span class="btn btn-success waves-effect waves-light">Опубликован</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('delete.review', $item->id) }}" class="btn btn-danger waves-effect waves-light" id="delete">Удалить</a>
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

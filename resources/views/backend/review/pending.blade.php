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
                        <h4 class="page-title">Комментарии в ожидании <span class="btn btn-danger"> {{ count($review) }}</span> </h4>
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
                                    <th>Обложка новости</th>
                                    <th>Новость</th>
                                    <th>Пользователь</th>
                                    <th>Комментарий</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>


                                <tbody>
@foreach($review as $key=> $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td><img src="{{ asset($item->news->image) }}" class="rounded-circle avatar-lg img-thumbnail"   alt="profile-image" style="height: 100px; width: 100px;"> </td>
        <td title="{{ $item->news->title_ru }}">{{ Str::limit($item->news->title_ru, 50) }}</td>
        <td>{{ $item->user->name ?? 'Гость'}}</td>
        <td> {{ Str::limit($item->comment, 50) }}</td>
        <td>  <a href="{{ route('review.approve', $item->id) }}" class="btn btn-primary waves-effect waves-light">Опубликовать</a> </td>
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

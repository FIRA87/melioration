@extends('admin.admin_dashboard')
@section('admin')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('add.projects') }}" class="btn btn-blue waves-effect waves-light text-white">Добавить </a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Проекты</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название TJ</th>
                                    <th>Slug</th>
                                    <th>Изображение</th>
                                    <th>Статус</th>
                                    <th>Сортировка</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->title_tj }}</td>
                                    <td>{{ $project->slug }}</td>
                                    <td>
                                        @if($project->image)
                                            <img src="{{ asset($project->image) }}" alt="{{ $project->title_tj }}" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            Нет изображения
                                        @endif
                                    </td>
                                    <td>
                                        @if($project->status == 1)
                                            <span class="badge bg-success">Активен</span>
                                        @else
                                            <span class="badge bg-danger">Неактивен</span>
                                        @endif
                                    </td>
                                    <td>{{ $project->sort }}</td>
                                    <td>
                                        <a href="{{ route('edit.projects', $project->id) }}" class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>  </a>
                                        <a href="{{ route('delete.projects', $project->id) }}" class="btn btn-danger waves-effect waves-light" id="delete"> <i class="fa-solid fa-trash"></i>  </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


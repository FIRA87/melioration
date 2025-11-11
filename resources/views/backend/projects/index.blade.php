@extends('admin.admin_dashboard')
@section('admin')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a href="{{ route('add.projects') }}" class="btn btn-blue waves-effect waves-light text-white">
                                <i class="fa fa-plus"></i> Добавить проект
                            </a>
                        </div>
                        <h4 class="page-title">Проекты</h4>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body table-responsive">
                    <table id="basic-datatable" class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Название RU</th>
                                <th>Slug</th>
                                <th>Изображение</th>
                                <th>Статус</th>
                                <th>Сортировка</th>
                                <th class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->title_ru }}</td>
                                    <td>{{ $project->slug }}</td>
                                    <td>
                                        @if ($project->image)
                                            <img src="{{ asset($project->image) }}"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Нет изображения</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($project->status)
                                            <span class="badge bg-success">Активен</span>
                                        @else
                                            <span class="badge bg-danger">Неактивен</span>
                                        @endif
                                    </td>
                                    <td>{{ $project->sort }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit.projects', $project->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="{{ route('delete.projects', $project->id) }}" id="delete"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

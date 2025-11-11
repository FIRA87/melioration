@extends('admin.admin_dashboard')
@section('admin')
    <div class="container py-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Вакансии</h4>
            <a href="{{ route('jobs.create') }}" class="btn btn-primary">Добавить вакансию</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок (TJ)</th>
                    <th>Изображение</th>
                    <th>Активна</th>
                    <th>Сорт</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->title_tj }}</td>
                        <td>
                            @if ($job->image)
                                <img src="{{ asset($job->image) }}" style="width:80px;height:60px;object-fit:cover">
                            @endif
                        </td>
                        <td>{!! $job->is_active ? '<span class="badge bg-success">Да</span>' : '<span class="badge bg-danger">Нет</span>' !!}</td>
                        <td>{{ $job->sort }}</td>
                        <td>
                            <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-primary">Редакт</a>
                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" style="display:inline-block"
                                onsubmit="return confirm('Удалить?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('admin.admin_dashboard')
@section('admin')



<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Заявки на вакансии</h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Вакансия</th>
                                    <th>Кандидат</th>
                                    <th>Email</th>
                                    <th>Телефон</th>
                                    <th>Статус</th>
                                    <th>Дата подачи</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $app)
                                    <tr>
                                        <td>{{ $app->id }}</td>
                                        <td>{{ $app->job->title_ru ?? $app->job->title_tj }}</td>
                                        <td>{{ $app->full_name }}</td>
                                        <td>{{ $app->email }}</td>
                                        <td>{{ $app->phone }}</td>
                                        <td>
                                            @switch($app->status)
                                                @case('new')
                                                    <span class="badge bg-info">Новая</span>
                                                    @break
                                                @case('reviewed')
                                                    <span class="badge bg-warning">Просмотрена</span>
                                                    @break
                                                @case('accepted')
                                                    <span class="badge bg-success">Принята</span>
                                                    @break
                                                @case('rejected')
                                                    <span class="badge bg-danger">Отклонена</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ $app->created_at->format('d.m.Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('backend.applications.show', $app->id) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Просмотр
                                            </a>
                                            <form action="{{ route('backend.applications.destroy', $app->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Удалить заявку?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Нет заявок</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Заявка #{{ $application->id }}</h3>
                    <a href="{{ route('backend.applications.index') }}" class="btn btn-sm btn-secondary float-end">
                        <i class="fas fa-arrow-left"></i> Назад
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Информация о вакансии -->
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Вакансия</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Название:</strong> {{ $application->job->title_ru ?? $application->job->title_tj }}</p>
                            @if($application->job->location)
                                <p><strong>Местоположение:</strong> {{ $application->job->location }}</p>
                            @endif
                            @if($application->job->salary)
                                <p><strong>Зарплата:</strong> {{ $application->job->salary }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Информация о кандидате -->
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Информация о кандидате</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Имя:</strong> {{ $application->first_name }}</p>
                                    <p><strong>Фамилия:</strong> {{ $application->last_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> <a href="mailto:{{ $application->email }}">{{ $application->email }}</a></p>
                                    <p><strong>Телефон:</strong> <a href="tel:{{ $application->phone }}">{{ $application->phone }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Сопроводительное письмо -->
                    @if($application->cover_letter)
                        <div class="card mb-3">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Сопроводительное письмо</h5>
                            </div>
                            <div class="card-body">
                                <p>{{ $application->cover_letter }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Документы -->
                    <div class="card mb-3">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Документы</h5>
                        </div>
                        <div class="card-body">
                            <p>
                                <strong>Резюме:</strong>
                                <a href="{{ route('backend.applications.resume', $application->id) }}" 
                                   class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fas fa-download"></i> Скачать резюме
                                </a>
                            </p>

                            @if($application->additional_files && count($application->additional_files) > 0)
                                <p><strong>Дополнительные файлы:</strong></p>
                                <ul>
                                    @foreach($application->additional_files as $index => $file)
                                        <li>
                                            <a href="{{ route('backend.applications.attachment', ['application' => $application->id, 'index' => $index]) }}" 
                                               class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-file"></i> Файл {{ $index + 1 }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Управление статусом -->
                    <div class="card mb-3">
                        <div class="card-header bg-warning">
                            <h5 class="mb-0">Управление заявкой</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.applications.status', $application->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label class="form-label">Статус</label>
                                    <select name="status" class="form-select" required>
                                        <option value="new" {{ $application->status == 'new' ? 'selected' : '' }}>Новая</option>
                                        <option value="reviewed" {{ $application->status == 'reviewed' ? 'selected' : '' }}>Просмотрена</option>
                                        <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Принята</option>
                                        <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Отклонена</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Заметки администратора</label>
                                    <textarea name="admin_notes" class="form-control" rows="4">{{ $application->admin_notes }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Сохранить
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Информация о заявке -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Дополнительная информация</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Дата подачи:</strong> {{ $application->created_at->format('d.m.Y H:i:s') }}</p>
                            <p><strong>Последнее обновление:</strong> {{ $application->updated_at->format('d.m.Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin.admin_dashboard')
@section('admin')
    <div class="container py-4">
        <div class="d-flex justify-content-between mb-3">
            <h3>Опросы</h3>
            <a href="{{ route('surveys.create') }}" class="btn btn-success">Создать опрос</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок (RU)</th>
                    <th>Вопросов</th>
                    <th>Всего голосов</th>
                    <th>Активен</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surveys as $s)
                    @php
                        $totalVotes = 0;
                        foreach ($s->questions as $q) {
                            $totalVotes += $q->answers->count();
                        }
                    @endphp
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->title_ru }}</td>
                        <td>{{ $s->questions->count() }}</td>
                        <td>{{ $totalVotes }}</td>
                        <td>{!! $s->is_active ? '<span class="badge bg-success">Да</span>' : '<span class="badge bg-secondary">Нет</span>' !!}</td>
                        <td>
                            <a href="{{ route('surveys.show', $s) }}" class="btn btn-sm btn-primary">Статистика</a>
                            <a href="{{ route('surveys.edit', $s) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <form action="{{ route('surveys.destroy', $s) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Удалить опрос?')">
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

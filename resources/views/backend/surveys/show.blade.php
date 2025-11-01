@extends('admin.admin_dashboard')
@section('admin')


<div class="container mt-4">
    <h3>Опрос: {{ $survey->title }}</h3>

    <p>
        Статус: 
        @if($survey->is_active)
            <span class="badge bg-success">Активен</span>
        @else
            <span class="badge bg-secondary">Неактивен</span>
        @endif
    </p>

    <hr>

    <h5>Вопросы:</h5>

    @if($survey->questions->count())
        <ul class="list-group">
            @foreach($survey->questions as $question)
                <li class="list-group-item">
                    <strong>{{ $question->text }}</strong>
                    <ul>
                        @foreach($question->options as $opt)
                            <li>{{ $opt->text }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @else
        <p>Пока нет вопросов.</p>
    @endif

    <a href="{{ route('admin.surveys.index') }}" class="btn btn-secondary mt-3">Назад</a>
</div>
@endsection

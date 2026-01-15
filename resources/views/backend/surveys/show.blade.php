@extends('admin.admin_dashboard')
@section('admin')
@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 


    <div class="container py-4">
        <h3>Статистика: {{ $survey->title_ru }}</h3>
        <p>{{ $survey->description_ru }}</p>

        @foreach ($survey->questions as $q)
            <div class="card mb-3 p-3">
                <h5>{{ $q->text_ru }}</h5>
                @php $total = $q->answers->count(); @endphp
                <p>Всего голосов: <strong>{{ $total }}</strong></p>

                <ul class="list-group">
                    @foreach ($q->options as $opt)
                        @php
                            $count = $opt->answers->count();
                            $percent = $total ? round(($count / $total) * 100, 1) : 0;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>{{ $opt->text_ru }}</div>
                            <div><span class="badge bg-primary">{{ $count }}</span>
                                <small>{{ $percent }}%</small></div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

        <a href="{{ route('surveys.index') }}" class="btn btn-secondary">Назад</a>
    </div>

    @else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif
@endsection

@extends('frontend.master')


@section('title')
    @if(session()->get('lang') == 'ru')
        {{ $job->title_ru }}
    @elseif(session()->get('lang') == 'en')
        {{ $job->title_en }}
    @else
         {{ $job->title_tj }}
    @endif
@endsection


@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.jobs.index') }}">
                            @if(session()->get('lang') == 'ru')
                                Вакансии
                            @elseif(session()->get('lang') == 'en')
                                Vacancies
                            @else
                                Ҷойҳои кории холӣ
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $job->{'title_'.app()->getLocale()} }}</li>
                </ol>
            </nav>

            <div class="card shadow-sm">
                @if($job->image)
                    <img src="{{ asset($job->image) }}" 
                         class="card-img-top" 
                         alt="{{ $job->{'title_'.app()->getLocale()} }}"
                         style="max-height: 400px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <h1 class="card-title mb-4">{{ $job->{'title_'.app()->getLocale()} }}</h1>

                    <div class="row mb-4">
                        @if($job->location)
                            <div class="col-md-6 mb-2">
                                <strong><i class="fas fa-map-marker-alt"></i> 
                                    @if(session()->get('lang') == 'ru')
                                        Местоположение
                                    @elseif(session()->get('lang') == 'en')
                                        Location
                                    @else
                                        Ҷойгиршавӣ
                                    @endif:</strong> {{ $job->location }}
                            </div>
                        @endif

                        @if($job->salary)
                            <div class="col-md-6 mb-2">
                                <strong><i class="fas fa-money-bill-wave"></i> 
                                    @if(session()->get('lang') == 'ru')
                                        Зарплата
                                    @elseif(session()->get('lang') == 'en')
                                        Salary
                                    @else
                                        Музди меҳнат
                                    @endif:</strong> {{ $job->salary }}
                            </div>
                        @endif

                        @if($job->start_date)
                            <div class="col-md-6 mb-2">
                                <strong><i class="fas fa-calendar-alt"></i> 
                                    @if(session()->get('lang') == 'ru')
                                        Дата начала
                                    @elseif(session()->get('lang') == 'en')
                                        Start Date
                                    @else
                                        Санаи оғоз
                                    @endif:</strong> {{ $job->start_date->format('d.m.Y') }}
                            </div>
                        @endif

                        @if($job->end_date)
                            <div class="col-md-6 mb-2">
                                <strong><i class="fas fa-calendar-times"></i> 
                                    @if(session()->get('lang') == 'ru')
                                        Дата окончания
                                    @elseif(session()->get('lang') == 'en')
                                        End Date
                                    @else
                                        Санаи хотима
                                    @endif:</strong> {{ $job->end_date->format('d.m.Y') }}
                            </div>
                        @endif
                    </div>

                    @if($job->{'description_'.app()->getLocale()})
                        <div class="mb-4">
                            <h4>
                                @if(session()->get('lang') == 'ru')
                                    Описание
                                @elseif(session()->get('lang') == 'en')
                                    Description
                                @else
                                    Тавсиф
                                @endif
                            </h4>
                            <div class="text-justify">{!! nl2br(e($job->{'description_'.app()->getLocale()})) !!}</div>
                        </div>
                    @endif

                    @if($job->{'requirements_'.app()->getLocale()})
                        <div class="mb-4">
                            <h4>
                                @if(session()->get('lang') == 'ru')
                                    Требования
                                @elseif(session()->get('lang') == 'en')
                                    Requirements
                                @else
                                    Талабот
                                @endif
                            </h4>
                            <div class="text-justify">{!! nl2br(e($job->{'requirements_'.app()->getLocale()})) !!}</div>
                        </div>
                    @endif

                    @if($job->attachments && count($job->attachments) > 0)
                        <div class="mb-4">
                            <h4>
                                @if(session()->get('lang') == 'ru')
                                    Документы
                                @elseif(session()->get('lang') == 'en')
                                    Documents
                                @else
                                    Ҳуҷҷатҳо
                                @endif
                            </h4>
                            <ul class="list-unstyled">
                                @foreach($job->attachments as $index => $file)
                                    <li class="mb-2">
                                        <a href="{{ route('frontend.jobs.download', ['job' => $job->id, 'index' => $index]) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-download"></i> 
                                            @if(session()->get('lang') == 'ru')
                                                Скачать документ
                                            @elseif(session()->get('lang') == 'en')
                                                Download document
                                            @else
                                                Боргирии ҳуҷҷат
                                            @endif {{ $index + 1 }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('frontend.jobs.apply', $job->slug) }}" class="btn btn-success btn-lg" style="color: #ffffff !important;">
                            <i class="fas fa-paper-plane"></i> 
                            @if(session()->get('lang') == 'ru')
                                Подать заявку
                            @elseif(session()->get('lang') == 'en')
                                Apply
                            @else
                                Аризадиҳӣ
                            @endif
                        </a>
                        <a href="{{ route('frontend.jobs.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                            <i class="fas fa-arrow-left"></i> 
                            @if(session()->get('lang') == 'ru')
                                Назад к вакансиям
                            @elseif(session()->get('lang') == 'en')
                                Back to Vacancies
                            @else
                                Бозгашт ба вакансияҳо
                            @endif
                        </a>
                    </div>
                </div>
            </div>

            <!-- Дополнительная информация -->
            <div class="card mt-4 bg-light">
                <div class="card-body">
                    <h5 class="mb-3">
                        <i class="fas fa-info-circle"></i> 
                        @if(session()->get('lang') == 'ru')
                            Дополнительная информация
                        @elseif(session()->get('lang') == 'en')
                            Additional Information
                        @else
                            Маълумоти иловагӣ
                        @endif
                    </h5>
                    <p class="mb-2">
                        <strong>
                            @if(session()->get('lang') == 'ru')
                                Дата публикации
                            @elseif(session()->get('lang') == 'en')
                                Publication Date
                            @else
                                Санаи нашр
                            @endif:</strong> {{ $job->created_at->format('d.m.Y') }}
                    </p>
                    @if($job->end_date)
                        <p class="mb-0">
                            <strong>
                                @if(session()->get('lang') == 'ru')
                                    Прием заявок до
                                @elseif(session()->get('lang') == 'en')
                                    Applications accepted until
                                @else
                                    Қабули аризаҳо то
                                @endif:</strong> {{ $job->end_date->format('d.m.Y') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-justify {
        text-align: justify;
    }
    
    .card {
        border-radius: 10px;
    }
    
    .card-img-top {
        border-radius: 10px 10px 0 0;
    }
    
    h4 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e9ecef;
    }
</style>
@endsection
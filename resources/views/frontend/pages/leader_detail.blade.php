@extends('frontend.master')

@section('title')
    @if(session('lang')=='ru') 
        {{ $leader->title_ru }}
    @elseif(session('lang')=='en') 
        {{ $leader->title_en }}
    @else
         {{ $leader->title_tj }}
    @endif
@endsection

@section('content')
<div class="min-h-screen bg-light py-3 py-md-5">
    <div class="container">

        <!-- Кнопка "Вернуться назад" -->
        <a href="{{ route('frontend.leader') }}" class="btn btn-link text-decoration-none mb-3 mb-md-4 d-inline-flex align-items-center px-0">
            <i class="bi bi-arrow-left me-2"></i>
            <span class="d-none d-sm-inline">Вернуться назад</span>
            <span class="d-inline d-sm-none">Назад</span>
        </a>

        <!-- Основная карточка -->
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

            <!-- Секция с фото - центрированная -->
            <div class="card-body text-center py-4 py-md-5 px-3 px-md-4" style="background: linear-gradient(to bottom, #f8f9fa, #ffffff);">
                
                <!-- Фото -->
                <div class="d-flex justify-content-center align-items-center mb-3 mb-md-4 leader-photo-container">
                    @if(!empty($leader->image) || !empty($leader->photo))
                        <img src="{{ asset($leader->image ?? $leader->photo) }}"
                             alt="{{ session('lang')=='ru' ? $leader->title_ru : (session('lang')=='en' ? $leader->title_en : $leader->title_tj) }}"
                             class="rounded-circle shadow-lg border border-4 border-white leader-photo"
                             style="width: 150px !important; height: 150px !important; object-fit: cover; display: block;">
                    @else
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center leader-photo-placeholder" 
                             style="width: 150px !important; height: 150px !important;"> 
                            <i class="bi bi-person-circle text-white" style="font-size: 60px !important;"></i>
                        </div>
                    @endif
                </div>

                <!-- ФИО -->
                <h1 class="fw-bold text-dark mb-2 px-2" style="font-size: 1.25rem;">
                    @if(session('lang')=='ru')
                        {{ $leader->title_ru }}
                    @elseif(session('lang')=='en')
                        {{ $leader->title_en }}
                    @else
                        {{ $leader->title_tj }}
                    @endif
                </h1>

                <!-- Должность -->
                <p class="text-primary fw-semibold mb-3 mb-md-4 px-2" style="font-size: 1rem;">
                    @if(session('lang')=='ru')
                        {{ $leader->position_ru }}
                    @elseif(session('lang')=='en')
                        {{ $leader->position_en }}
                    @else
                        {{ $leader->position_tj }}
                    @endif
                </p>

                <hr class="mx-auto border-2 border-primary opacity-50 mb-3 mb-md-4" style="width: 50%;">

                <!-- Контактная информация -->
                <div class="row g-2 g-md-3 justify-content-center px-2">
                    
                    @if(!empty($leader->phone))
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="card border-0 bg-light h-100 p-2 p-md-3">
                            <div class="card-body text-center p-2">
                                <i class="bi bi-telephone-fill text-primary mb-2" style="font-size: 20px !important;"></i>
                                <p class="text-muted mb-1" style="font-size: 0.85rem;">Телефон</p>
                                <a href="tel:{{ $leader->phone }}" class="text-dark text-decoration-none fw-semibold d-block" style="font-size: 0.9rem !important;">
                                    {{ $leader->phone }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($leader->email))
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="card border-0 bg-light h-100 p-2 p-md-3">
                            <div class="card-body text-center p-2">
                                <i class="bi bi-envelope-fill text-primary mb-2" style="font-size: 20px !important;"></i>
                                <p class="text-muted mb-1" style="font-size: 0.85rem;">Электронная почта</p>
                                <a href="mailto:{{ $leader->email }}" class="text-dark text-decoration-none fw-semibold text-break d-block" style="font-size: 0.85rem !important; word-break: break-word;">
                                    {{ $leader->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($leader->working_days))
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="card border-0 bg-light h-100 p-2 p-md-3">
                            <div class="card-body text-center p-2">
                                <i class="bi bi-calendar3 text-primary mb-2" style="font-size: 20px !important;"></i>
                                <p class="text-muted mb-1" style="font-size: 0.85rem;">График работы</p>
                                <p class="text-dark fw-semibold mb-0" style="font-size: 0.9rem !important;">
                                    {{ $leader->working_days }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

            </div>

            <!-- Биография -->
          
            <div class="card-body bg-white p-3 p-md-5">
                <div class="mx-auto" style="max-width: 900px;">
                    <h2 class="h5 h4-md fw-bold text-dark mb-3 mb-md-4 pb-2 border-start border-4 border-primary ps-3">
                          @if(session('lang')=='ru')
                             Биография
                        @elseif(session('lang')=='en')
                              Biography
                        @else
                              Биография
                        @endif

                      
                    </h2>
                    <div class="text-muted lh-lg biography-content">
                        @if(session('lang')=='ru')
                            {!! $leader->text_ru !!}
                        @elseif(session('lang')=='en')
                            {!! $leader->text_en !!}
                        @else
                            {!! $leader->text_tj !!}
                        @endif
                    </div>
                </div>
            </div>
         

        </div>
    </div>
</div>

<style>
    /* Базовые стили для всех устройств */
    * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    
    /* Центрирование фото на всех устройствах */
    .leader-photo-container {
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    
    .leader-photo,
    .leader-photo-placeholder {
        margin: 0 auto !important;
        flex-shrink: 0 !important;
    }
    
    /* Адаптивные размеры фото */
    @media (min-width: 768px) {
        .card-body img.rounded-circle {
            width: 200px !important;
            height: 200px !important;
        }
        
        .card-body h1 {
            font-size: 2rem !important;
        }
        
        .card-body p.text-primary {
            font-size: 1.25rem !important;
        }
        
        hr {
            width: 25% !important;
        }
    }
    
    /* Улучшенная типографика для мобильных */
    @media (max-width: 767px) {
        /* Стили для биографии - исправляем проблему с разрывом текста */
        .biography-content {
            font-size: 0.95rem !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            word-break: normal !important;
            white-space: normal !important;
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        .biography-content * {
            display: inline !important;
            white-space: normal !important;
            word-break: normal !important;
        }
        
        .biography-content p,
        .biography-content div,
        .biography-content h1,
        .biography-content h2,
        .biography-content h3,
        .biography-content h4,
        .biography-content h5,
        .biography-content h6,
        .biography-content ul,
        .biography-content ol,
        .biography-content li {
            display: block !important;
            white-space: normal !important;
            word-break: normal !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        .biography-content p {
            margin-bottom: 0.75rem !important;
        }
        
        /* Центрирование фото на мобильных */
        .leader-photo-container {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
        
        .leader-photo,
        .leader-photo-placeholder {
            display: block !important;
            margin: 0 auto !important;
            flex-shrink: 0 !important;
        }
        
        .row {
            display: flex !important;
            flex-wrap: wrap !important;
        }
        
        .col-12 {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }
    
    /* Дополнительные стили для улучшения внешнего вида */
    .card {
        transition: all 0.3s ease;
    }
    
    .card-body .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .btn-link:hover {
        opacity: 0.8;
    }
    
    /* Улучшение читаемости на маленьких экранах */
    @media (max-width: 575px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
        
        .card {
            border-radius: 1rem !important;
        }
        
        /* Убираем лишние отступы */
        .min-h-screen {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }
        
        /* Дополнительные стили для биографии на очень маленьких экранах */
        .biography-content {
            font-size: 0.9rem !important;
            line-height: 1.6 !important;
        }
        
        .biography-content p {
            margin-bottom: 0.5rem !important;
        }
    }
    
    /* Улучшение контактных карточек на мобильных */
    @media (max-width: 575px) {
        .card-body .card {
            min-height: 100px !important;
            display: block !important;
        }
    }
</style>
@endsection
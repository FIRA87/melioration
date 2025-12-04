@extends('frontend.master')
@section('title')
    @if (session()->get('lang') == 'ru')
        {{ $project->title_ru }}
    @elseif(session()->get('lang') == 'en')
        {{ $project->title_en }}
    @else
        {{ $project->title_tj }}
    @endif
@endsection

@section('content')
<!-- Banner Start -->
<section class="custom-banner">
    <div class="container">
        <div class="custom-banner-content">          
           <h1 class="mb-4 fw-bold text-left" >
            @if (session()->get('lang') == 'ru')
                {{ $project->title_ru }}
            @elseif(session()->get('lang') == 'en')
                {{ $project->title_en }}
            @else
                {{ $project->title_tj }}
            @endif
        </h1>
        </div>
    </div>
</section>
<!-- Banner End -->

<!-- Кнопка "Назад" -->
<section class="py-3 bg-light">
    <div class="container">
        <a href="{{ route('frontend.projects') }}" class="text-decoration-none text-dark d-inline-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i>
           @if (session()->get('lang') == 'ru')
                        Наши проекты
                    @elseif(session()->get('lang') == 'en')
                        Our Projects
                    @else
                        Лоиҳаҳои мо
                    @endif
        </a>
    </div>
</section>

<div class="container py-5">   
    <!-- Основное изображение -->
    @if($project->image)
        <img src="/{{ $project->image }}" class="img-fluid rounded shadow-sm mb-4" alt="{{ $project->title_tj }}">
    @endif

    <!-- Даты проекта -->
    @if($project->start_date || $project->end_date)
        <div class="project-dates mb-4">
            <div class="row g-3">
                @if($project->start_date)
                    <div class="col-md-6">
                        <div class="date-card">
                            <div class="date-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="date-content">
                                <h6 class="date-label">
                                    @if (session()->get('lang') == 'ru')
                                        Дата начала
                                    @elseif(session()->get('lang') == 'en')
                                        Start Date
                                    @else
                                        Санаи оғоз
                                    @endif
                                </h6>
                                <p class="date-value">{{ \Carbon\Carbon::parse($project->start_date)->format('d.m.Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($project->end_date)
                    <div class="col-md-6">
                        <div class="date-card">
                            <div class="date-icon">
                                <i class="bi bi-calendar-x"></i>
                            </div>
                            <div class="date-content">
                                <h6 class="date-label">
                                    @if (session()->get('lang') == 'ru')
                                        Дата окончания
                                    @elseif(session()->get('lang') == 'en')
                                        End Date
                                    @else
                                        Санаи анҷом
                                    @endif
                                </h6>
                                <p class="date-value">{{ \Carbon\Carbon::parse($project->end_date)->format('d.m.Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
 
    <!-- Текст проекта -->
    <div class="project-text mb-5" style="font-size: 18px; line-height: 1.8;">
        @if (session()->get('lang') == 'ru')
            {!! $project->text_ru !!}
        @elseif(session()->get('lang') == 'en')
            {!! $project->text_en !!}
        @else
            {!! $project->text_tj !!}
        @endif
    </div>

    <!-- Галерея изображений -->
    @if($project->gallery)
        @php
            // Проверяем тип данных и обрабатываем соответственно
            if (is_string($project->gallery)) {
                $galleryImages = json_decode($project->gallery, true);
            } else {
                $galleryImages = $project->gallery;
            }
        @endphp
        
        @if(is_array($galleryImages) && count($galleryImages) > 0)
            <div class="project-gallery">
                <h3 class="mb-4 fw-bold">
                    @if (session()->get('lang') == 'ru')
                        Галерея проекта
                    @elseif(session()->get('lang') == 'en')
                        Project Gallery
                    @else
                        Галереяи лоиҳа
                    @endif
                </h3>
                
                <div class="row g-3">
                    @foreach($galleryImages as $index => $image)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="gallery-item">
                                <a href="{{ asset($image) }}" 
                                   data-lightbox="project-gallery" 
                                   data-title="@if (session()->get('lang') == 'ru'){{ $project->title_ru }}@elseif(session()->get('lang') == 'en'){{ $project->title_en }}@else{{ $project->title_tj }}@endif - Фото {{ $index + 1 }}">
                                    <img src="{{ asset($image) }}" 
                                         class="img-fluid rounded shadow-sm" 
                                         alt="Gallery Image {{ $index + 1 }}"
                                         loading="lazy">
                                    <div class="gallery-overlay">
                                        <i class="bi bi-zoom-in"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>

<style>
    /* ==== Modern Banner ==== */
    .custom-banner {
        background: #f7f9fc;
        padding: 60px 0;
        border-bottom: 1px solid #e4e7eb;
    }
    .custom-banner-content {
        text-align: left;
        animation: fadeIn 0.8s ease-in-out;
    }

    /* ==== Date Cards ==== */
    .project-dates {
        margin-bottom: 30px;
    }

    .date-card {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px 25px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .date-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .date-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        flex-shrink: 0;
    }

    .date-icon i {
        font-size: 28px;
        color: #fff;
    }

    .date-content {
        flex: 1;
    }

    .date-label {
        font-size: 14px;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9);
        margin: 0 0 5px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .date-value {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        margin: 0;
    }

    /* ==== Gallery Styles ==== */
    .project-gallery {
        margin-top: 50px;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .gallery-item img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.15);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 112, 201, 0.8), rgba(0, 74, 136, 0.8));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay i {
        color: #fff;
        font-size: 40px;
        animation: zoomPulse 0.6s ease-in-out;
    }

    @keyframes zoomPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    /* Fade animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ==== Mobile ==== */
    @media (max-width: 768px) {
        .custom-banner {
            padding: 40px 0;
        }
        .gallery-item img {
            height: 220px;
        }
        .date-card {
            padding: 15px 20px;
        }
        .date-icon {
            width: 50px;
            height: 50px;
        }
        .date-icon i {
            font-size: 24px;
        }
        .date-value {
            font-size: 18px;
        }
    }

    @media (max-width: 576px) {
        .custom-banner {
            padding: 35px 0;
        }
        .gallery-item img {
            height: 200px;
        }
        .gallery-overlay i {
            font-size: 32px;
        }
    }
</style>

<!-- Lightbox библиотека для просмотра изображений -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    // Настройки Lightbox
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': "Изображение %1 из %2",
        'fadeDuration': 300,
        'imageFadeDuration': 300
    });
</script>

@endsection
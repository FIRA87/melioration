@extends('frontend.master')

@section('title')
@trans('leadership')
@endsection


@section('content')

<!-- Banner Start -->
<section class="custom-banner">
    <div class="container">
        <div class="custom-banner-content">          
            <h1 class="custom-banner-title text-left">
             @trans('leadership')
            </h1>
        </div>
    </div>
</section>
<!-- Banner End -->

<div class="py-5 min-vh-100">
    <div class="container">
        @if($allLeaders->count())
            <div class="row g-4">
                @foreach($allLeaders as $leader)
                    <div class="col-12">
                        <div class="leader-card">
                            <div class="row g-0">
                                <!-- Фото слева -->
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <a href="{{ route('frontend.leader.detail', $leader->id) }}" class="leader-photo-link">
                                        @if($leader->image)
                                            <div class="leader-photo-container">
                                                <img src="{{ asset($leader->image) }}"
                                                     alt="{{ session('lang')=='ru' ? $leader->title_ru : (session('lang')=='en' ? $leader->title_en : $leader->title_tj) }}"
                                                     class="leader-photo">
                                            </div>
                                        @else
                                            <div class="leader-photo-placeholder">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                <!-- Информация справа -->
                                <div class="col-lg-9 col-md-8 col-sm-12">
                                    <div class="leader-info">
                                        <!-- ФИО -->
                                        <a href="{{ route('frontend.leader.detail', $leader->id) }}" class="leader-link">
                                            <h2 class="leader-name">
                                                @if(session('lang')=='ru')
                                                    {{ $leader->title_ru }}
                                                @elseif(session('lang')=='en')
                                                    {{ $leader->title_en }}
                                                @else
                                                    {{ $leader->title_tj }}
                                                @endif
                                            </h2>
                                        </a>

                                        <!-- Должность -->
                                        <p class="leader-position">
                                            @if(session('lang')=='ru')
                                                {{ $leader->position_ru }}
                                            @elseif(session('lang')=='en')
                                                {{ $leader->position_en }}
                                            @else
                                                {{ $leader->position_tj }}
                                            @endif
                                        </p>

                                        <!-- Контакты -->
                                        <div class="leader-contacts">
                                            @if(!empty($leader->email))
                                            <div class="contact-item">
                                                <span class="contact-label">E-mail:</span>
                                                <a href="mailto:{{ $leader->email }}" class="contact-value">{{ $leader->email }}</a>
                                            </div>
                                            @endif

                                            @if(!empty($leader->phone))
                                            <div class="contact-item">
                                                <span class="contact-label">
                                                    @if(session('lang')=='ru')
                                                        Телефон:
                                                    @elseif(session('lang')=='en')
                                                        Phone:
                                                    @else
                                                        Телефон:
                                                    @endif
                                                </span>
                                                <a href="tel:{{ $leader->phone }}" class="contact-value">{{ $leader->phone }}</a>
                                            </div>
                                            @endif

                                            @if(!empty($leader->working_days))
                                            <div class="contact-item">
                                                <span class="contact-label">
                                                    @if(session('lang')=='ru')
                                                        Рабочие дни:
                                                    @elseif(session('lang')=='en')
                                                        Working days:
                                                    @else
                                                        Рӯзҳои корӣ:
                                                    @endif
                                                </span>
                                                <span class="contact-value">{{ $leader->working_days }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                @if(session('lang')=='ru')
                    Список руководства пуст
                @elseif(session('lang')=='en')
                    Management list is empty
                @else
                    Рӯйхати роҳбарият холӣ аст
                @endif
            </div>
        @endif
    </div>
</div>

<style>
    /* Карточка руководителя */
    .leader-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        position: relative;
    }

    .leader-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
        pointer-events: none;
        z-index: 0;
    }

    .leader-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    /* Ссылка на фото */
    .leader-photo-link {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
    }

    .leader-link {
        text-decoration: none;
    }

    /* Фото - ДЕСКТОП */
    .leader-photo-container {
        width: 100%;
        height: 100%;
        min-height: 350px;
        position: relative;
        overflow: hidden;
    }

    .leader-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
        display: block;
    }

    .leader-photo-placeholder {
        width: 100%;
        height: 100%;
        min-height: 350px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .leader-photo-placeholder i {
        font-size: 100px;
        color: rgba(0, 0, 0, 0.2);
    }

    /* Информация - ДЕСКТОП */
    .leader-info {
        padding: 40px 50px;
        position: relative;
        z-index: 1;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .leader-name {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 15px 0;
        line-height: 1.3;
        transition: color 0.3s ease;
        text-shadow: none;
    }

    .leader-name:hover {
        color: #0d6efd;
    }

    .leader-position {
        font-size: 20px;
        font-weight: 500;
        color: #2c2c2c;
        margin: 0 0 30px 0;
        line-height: 1.4;
    }

    /* Контакты - ДЕСКТОП */
    .leader-contacts {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .contact-item {
        display: flex;
        align-items: baseline;
        gap: 8px;
        font-size: 17px;
        flex-wrap: wrap;
    }

    .contact-label {
        color: #4a4a4a;
        font-weight: 400;
        min-width: 140px;
    }

    .contact-value {
        color: #1a1a1a;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.3s ease;
        word-break: break-word;
    }

    a.contact-value:hover {
        color: #0d6efd;
        text-decoration: underline;
    }

    /* ========== ПЛАНШЕТЫ ========== */
    @media (max-width: 991px) {
        .leader-photo-container,
        .leader-photo-placeholder {
            min-height: 280px;
        }

        .leader-info {
            padding: 30px 35px;
        }

        .leader-name {
            font-size: 22px;
        }

        .leader-position {
            font-size: 18px;
        }

        .contact-item {
            font-size: 16px;
        }
    }

    /* ========== МОБИЛЬНЫЕ УСТРОЙСТВА ========== */
    @media (max-width: 767px) {
        .leader-card {
            display: flex;
            flex-direction: column;
        }

        .row {
            display: flex !important;
            flex-direction: column !important;
        }

        /* Фото - компактное круглое по центру */
        .col-lg-3, .col-md-4, .col-sm-12 {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
        }

        .leader-photo-link {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px 0 15px 0;
            background: linear-gradient(to bottom, #f8f9fa, #ffffff);
        }

        .leader-photo-container {
            width: 150px !important;
            height: 150px !important;
            min-height: 150px !important;
            max-height: 150px !important;
            border-radius: 50% !important;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            border: 4px solid #fff;
        }

        .leader-photo {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center center !important;
        }

        .leader-photo-placeholder {
            width: 150px !important;
            height: 150px !important;
            min-height: 150px !important;
            max-height: 150px !important;
            border-radius: 50% !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            border: 4px solid #fff;
        }

        .leader-photo-placeholder i {
            font-size: 60px !important;
        }

        /* Информация под фото - центрированная */
        .col-lg-9, .col-md-8 {
            width: 100% !important;
            max-width: 100% !important;
        }

        .leader-info {
            padding: 20px 20px 25px 20px !important;
            text-align: center !important;
            display: block !important;
        }

        .leader-name {
            font-size: 1.1rem !important;
            margin-bottom: 8px !important;
            display: block !important;
            text-align: center !important;
        }

        .leader-position {
            font-size: 0.95rem !important;
            margin-bottom: 20px !important;
            display: block !important;
            text-align: center !important;
            color: #0d6efd !important;
        }

        /* Разделительная линия */
        .leader-position::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: #0d6efd;
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* Контакты - красиво в столбик с иконками стиля */
        .leader-contacts {
            display: flex !important;
            flex-direction: column !important;
            gap: 15px !important;
            text-align: left !important;
            max-width: 350px;
            margin: 0 auto;
        }

        .contact-item {
            display: flex !important;
            flex-direction: column !important;
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 0 !important;
        }

        .contact-label {
            display: block !important;
            min-width: 0 !important;
            font-weight: 600 !important;
            margin-bottom: 5px !important;
            font-size: 0.75rem !important;
            color: #6c757d !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-value {
            display: block !important;
            font-size: 0.95rem !important;
            padding-left: 0 !important;
            color: #212529 !important;
            word-break: break-word;
        }

        a.contact-value {
            color: #0d6efd !important;
        }
    }

    /* ========== ОЧЕНЬ МАЛЕНЬКИЕ ЭКРАНЫ ========== */
    @media (max-width: 576px) {
        .leader-card {
            border-radius: 15px;
        }

        .leader-photo-container {
            min-height: 180px !important;
            max-height: 180px !important;
        }

        .leader-photo-placeholder {
            min-height: 180px !important;
            max-height: 180px !important;
        }

        .leader-photo-placeholder i {
            font-size: 60px !important;
        }

        .leader-info {
            padding: 18px 15px !important;
        }

        .leader-name {
            font-size: 17px !important;
            margin-bottom: 8px !important;
        }

        .leader-position {
            font-size: 15px !important;
            margin-bottom: 15px !important;
        }

        .contact-item {
            font-size: 13px !important;
            margin-bottom: 10px !important;
        }

        .contact-label {
            font-size: 12px !important;
        }

        .contact-value {
            font-size: 13px !important;
        }
    }

    /* ========== СУПЕР МАЛЕНЬКИЕ ЭКРАНЫ ========== */
    @media (max-width: 400px) {
        .leader-photo-container {
            min-height: 160px !important;
            max-height: 160px !important;
        }

        .leader-photo-placeholder {
            min-height: 160px !important;
            max-height: 160px !important;
        }

        .leader-photo-placeholder i {
            font-size: 50px !important;
        }

        .leader-info {
            padding: 15px 12px !important;
        }

        .leader-name {
            font-size: 16px !important;
        }

        .leader-position {
            font-size: 14px !important;
        }

        .contact-item {
            font-size: 12px !important;
        }

        .contact-label {
            font-size: 11px !important;
        }

        .contact-value {
            font-size: 12px !important;
        }
    }
</style>

@endsection
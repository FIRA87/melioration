@extends('frontend.master')

@section('title')
    @if(session()->get('lang') == 'ru')
        Фотогалерея
    @elseif(session()->get('lang') == 'en')
       Photo gallery
    @else
        Галереяи аксҳо
    @endif
@endsection


@section('content')
    <!-- Banner Start -->
    <section class="banner">
        <div class="container ">
            <div class="row gy-4 gy-sm-0 align-items-center">
                <div class="col-12 col-sm-6">
                    <div class="banner__content">
                        <h1 class="banner__title display-4 wow fadeInLeft" data-wow-duration="0.8s">
                             @if(session()->get('lang') == 'ru')
                        Фотогалерея
                    @elseif(session()->get('lang') == 'en')
                        Photo gallery
                    @else
                        Галереяи аксҳо
                    @endif
                        </h1> 
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb wow fadeInRight" data-wow-duration="0.8s">
                                <li class="breadcrumb-item">
                                          @if (session()->get('lang') == 'ru')
                            <a href="{{ url('/') }}" class="nav-item nav-link">Главная</a>
                        @elseif(session()->get('lang') == 'en')
                            <a href="{{ url('/') }}" class="nav-item nav-link">Main</a>
                        @else
                            <a href="{{ url('/') }}" class="nav-item nav-link">Асосӣ</a>
                        @endif
                                </li>
                                <li class="breadcrumb-item">
                                     @if(session()->get('lang') == 'ru')
                        Фотогалерея
                    @elseif(session()->get('lang') == 'en')
                        Photo gallery
                    @else
                        Галереяи аксҳо
                    @endif
                                </li>
           
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="banner__thumb text-end">
                        <img src="assets/images/service_banner.png" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->
    
    <!-- feature start -->
    <section class="feature feature--tertiary section">
        <div class="container">
            <div class="row g-3 g-sm-2 g-md-3 g-xxl-4">
                @foreach($galleries as $item)
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card--custom wow fadeInUp" data-wow-duration="0.8s">
                        <div >
                                <img class="w-100" src="/upload/cover/{{ $item->cover }}" alt="img" style="width: 100%; height: 250px">                      
                        </div>
                        <div class="card__content">
                            <h4 class="card__title"><a href="{{ url('gallery/details/' . $item->id) }}">
                                  @if (session()->get('lang') == 'ru')
                                                {{ $item->title_ru }}
                                            @elseif(session()->get('lang') == 'en')
                                                {{ $item->title_en }}
                                            @else
                                                {{ $item->title_tj }}
                                            @endif
                            </a></h4>
              
                            <a href="{{ url('gallery/details/' . $item->id) }}" class="btn_theme social_box"><i class="bi bi-arrow-up-right"></i><span></span></a>                            
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation" class="nav_pagination" data-wow-duration="0.8s">
                           {{ $galleries->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- feature end -->
@endsection

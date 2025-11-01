@extends('frontend.master')

@section('title')
    @if(session()->get('lang') == 'ru')
        Новости
    @elseif(session()->get('lang') == 'en')
        News
    @else
         Ахбор
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
                                    Новости
                                @elseif(session()->get('lang') == 'en')
                                    News
                                @else
                                     Ахбор
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
                                    Новости
                                @elseif(session()->get('lang') == 'en')
                                    News
                                @else
                                     Ахбор
                                @endif
                              </li>
                              
                 
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="banner__thumb text-end">
                        <img src="{{ asset('frontend/assets/images/blog_banner.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->
   





   <section class="blog section">
        <div class="container ">
            <div class="row gy-5 gy-lg-0">
                <div class="col-12 col-lg-7 col-xl-12">
                    <div class="row g-4">

                        @forelse($news as $item)
                            <div class="col-12 col-xl-4">
                                <div class="card card--secondary wow fadeInUp" data-wow-duration="0.8s">
                                    <a href="blog-details.html" class="card--secondary__thumb zoom_effect">
                                        <img src="{{ asset( $item->image) }}" alt="image">
                                    </a>
                                    <div class="card--secondary__content">
                                        <p class="card--secondary__time mb-4"><span class="gap-6"><i class="bi bi-person-circle"></i>Fingram</span><i class="bi bi-dot"></i> <span class="gap-6"><i class="bi bi-calendar3"></i>
                                                 @php
                                                $my_time = strtotime($item->created_at);
                                                $update_date = date('d.m.Y',$my_time);
                                            @endphp
                                            {{ $update_date }}
                                         </span></p>
                                        <h4><a href="{{ url('news/details/'.$item->id.'/'.$item->slug) }}">
                                              @if(session()->get('lang') == 'ru') 
                                                    {{ $item->title_ru }} 
                                              @elseif(session()->get('lang') == 'en') 
                                                    {{ $item->title_en }} 
                                              @else 
                                                    {{ $item->title_tj }}
                                              @endif
                                        </a></h4>
                                       
                                        <a href="{{ url('news/details/'.$item->id.'/'.$item->slug) }}" class="mt_32 read_more">
                                               @if (session()->get('lang') == 'ru')
                                                Подробнее
                                            @elseif(session()->get('lang') == 'en')
                                                Read more
                                            @else
                                                Бештар
                                            @endif
                                         <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                              <p>No posted   </p>
                        @endforelse
                    
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation" class="nav_pagination wow fadeInUp" data-wow-duration="0.8s">                             
                                     {{ $news->links() }}     
                            </nav>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </section>




@endsection

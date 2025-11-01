@extends('frontend.master')

@section('title')
    @if(session()->get('lang') == 'ru')
        Страница
    @elseif(session()->get('lang') == 'en')
        Page
    @else
         Саҳифа
    @endif
@endsection


@section('content')
    

        <!-- Banner Start -->
    <section class="banner">
        <div class="container ">
            <div class="row gy-4 gy-sm-0 align-items-center">
                <div class="col-12 col-sm-12">
                    <div class="banner__content">
                        <h1 class="banner__title display-4 wow fadeInLeft" data-wow-duration="0.8s">
                              @if(session()->get('lang') == 'ru')
                            {!! $pages->title_ru !!}
                        @elseif(session()->get('lang') == 'en')
                            {!!  $pages->title_en !!}
                        @else
                            {!! $pages->title_tj !!}
                        @endif
                        </h1> 
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb wow fadeInRight" data-wow-duration="0.8s">
                                <li class="breadcrumb-item"><a href="/">
                                    @if (session()->get('lang') == 'ru')
                    <a href="{{ url('/') }}" class="nav-item nav-link">Главная</a>
                @elseif(session()->get('lang') == 'en')
                    <a href="{{ url('/') }}" class="nav-item nav-link">Main</a>
                @else
                    <a href="{{ url('/') }}" class="nav-item nav-link">Асосӣ</a>
                @endif

                                </a></li>                     
                                <li class="breadcrumb-item active" aria-current="page">
                                @if(session()->get('lang') == 'ru')
                                    {!! $pages->title_ru !!}
                                @elseif(session()->get('lang') == 'en')
                                    {!!  $pages->title_en !!}
                                @else
                                    {!! $pages->title_tj !!}
                                @endif
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
    <!-- Banner End -->
  
    <!-- Choose Us start -->
    <section class="choose-us choose-us--secondary">
      
        <div class="container">
            <div class="row gy-5 gy-lg-0 justify-content-between align-items-center section">
                
                <div class="col-12 col-lg-12 ">
                    <div class="section__content ms-lg-4 ms-xl-0"> 
                     <div class="section__content-text wow fadeInDown" data-wow-duration="0.8s">                            
                        @if(session()->get('lang') == 'ru')
                            {!! $pages->text_ru !!}
                        @elseif(session()->get('lang') == 'en')
                            {!!  $pages->text_en !!}
                        @else
                            {!! $pages->text_tj !!}
                        @endif
                    </div>

             
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Choose Us end -->

<style type="text/css">
    
   .section__content-text img {
    float: left;
    margin: 0 15px 15px 0;
    height: auto;
}


</style>

@endsection

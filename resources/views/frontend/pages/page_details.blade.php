@extends('frontend.master')

@section('title')
   @if(session()->get('lang') == 'ru')
        {!! $menu->title_ru !!}
    @elseif(session()->get('lang') == 'en')
        {!! $menu->title_en !!}
    @else
        {!! $menu->title_tj !!}
    @endif
@endsection


@section('content')


<!-- Banner Start -->
<section class="custom-banner">
    <div class="container">
        <div class="custom-banner-content">          
     
                 <h1 class="custom-banner-title text-left">
                @if(session()->get('lang') == 'ru')
                    {!! $menu->title_ru !!}
                @elseif(session()->get('lang') == 'en')
                    {!! $menu->title_en !!}
                @else
                    {!! $menu->title_tj !!}
                @endif
              </h1>

        </div>
    </div>
</section>
<!-- Banner End -->


<!-- Choose Us start -->
<section class="choose-us choose-us--secondary">
  
    <div class="container">
        <div class="row gy-5 gy-lg-0 justify-content-between align-items-center section">            
            <div class="col-12 col-lg-12 ">
                <div class="section__content px-4 px-sm-0"> 
                 <div class="section__content-text wow fadeInDown" data-wow-duration="0.8s">                            
                  @if(session()->get('lang') == 'ru')
                    {!! $menu->text_ru !!}
                @elseif(session()->get('lang') == 'en')
                    {!! $menu->text_en !!}
                @else
                    {!! $menu->text_tj !!}
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


    /* ==== Modern Banner ==== */


    .custom-banner-content {
        text-align: left;
        animation: fadeIn 0.8s ease-in-out;
    }

    .custom-banner-title {
        font-size: 42px;
        font-weight: 700;
        color: #1d1d1d;
        margin: 0 0 15px 0;
        line-height: 1.2;
    }

    /* ==== Breadcrumb ==== */
    .custom-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .custom-breadcrumb-item {
        white-space: nowrap;
        font-size: 16px;
        color: #6c6c6c;
    }

    .custom-breadcrumb-item a {
        text-decoration: none;
        color: #0070c9;
        transition: color 0.2s ease;
    }

    .custom-breadcrumb-item a:hover {
        color: #004a88;
    }

    /* Slash separator */
    .custom-breadcrumb-item + .custom-breadcrumb-item::before {
        content: "/";
        color: #b4b4b4;
        padding: 0 4px;
    }

    /* Active breadcrumb */
    .custom-breadcrumb-item.active {
        color: #1d1d1d;
        font-weight: 600;
    }

    /* Fade animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ==== Mobile ==== */
    @media (max-width: 576px) {
        .custom-banner {
            padding: 35px 0;
        }
        .custom-banner-title {
            font-size: 30px;
        }
        .custom-breadcrumb-item {
            font-size: 14px;
        }
    }



</style>

@endsection

@extends('frontend.master')
@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  
<section class="banner">
        <div class="container ">
            <div class="row gy-4 gy-sm-0 align-items-center">
                <div class="col-12 col-sm-7">
                    <div class="banner__content">
    <h1 class="banner__title display-5 wow fadeInLeft" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInLeft;">
                            @if (session()->get('lang') == 'ru')
                                {{ $gallery->title_ru }}
                            @elseif(session()->get('lang') == 'en')
                                {{ $gallery->title_en }}
                            @else
                                {{ $gallery->title_tj }}
                            @endif             
                        </h1> 
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb wow fadeInRight" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInRight;">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        @if (session()->get('lang') == 'ru')
                                            Главная
                                        @elseif(session()->get('lang') == 'en')
                                            Main
                                        @else
                                           Асосӣ
                                        @endif 
                                    </a>
                               </li>
                            
                                <li class="breadcrumb-item active" aria-current="page">
                                  @if (session()->get('lang') == 'ru')
                                        {{ $gallery->title_ru }}
                                    @elseif(session()->get('lang') == 'en')
                                        {{ $gallery->title_en }}
                                    @else
                                        {{ $gallery->title_tj }}
                                    @endif
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-sm-5">
                    <div class="banner__thumb text-end">
                        <img src="/frontend/assets/images/reviews_banner.png" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>




   <!-- loan-reviews-details start -->
    <section class="reviews-details section">
        <div class="container ">
            <div class="row">
            
                <div class="col-12 col-xl-12 order-1 order-xl-0">
                    <div class="reviews-details__area">
                        <div class="reviews-details__part wow fadeInUp" data-wow-duration="0.8s">
                            <div class="section__content wow fadeInUp" data-wow-duration="0.8s">
                                <h2 class="section__content-title">
                                    @if (session()->get('lang') == 'ru')
                                        {{ $gallery->title_ru }}
                                    @elseif(session()->get('lang') == 'en')
                                        {{ $gallery->title_en }}
                                    @else
                                        {{ $gallery->title_tj }}
                                    @endif
                                </h2>
                                <p class="section__content-text">
                                      @if (session()->get('lang') == 'ru')
                                {!! $gallery->text_ru !!}
                            @elseif(session()->get('lang') == 'en')
                                {!! $gallery->text_en !!}
                            @else
                                {!! $gallery->text_tj !!}
                            @endif
                                </p>


                <div class="photo-gallery mt-5">
                    <div class="row">
                        @foreach ($gallery->images as $item)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="photo-thumb image-link">
                                    <img src="/upload/gallery/{{ $item->image }}" alt="5">
                                    <div class="bg"></div>
                                    <div class="icon">
                                        <a href="/upload/gallery/{{ $item->image }}" class="magnific"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="photo-caption">
                                    <a href="" style="color: #01b4ee">{{ $item->title_ru }}</a>
                                </div>

                            </div>
                        @endforeach

           
                            </div>
                      
                        </div>
                     
                    </div>
                </div>
             
            </div>
        </div>
    </section>
    <!-- loan-reviews-details end -->
 

<style>
    .photo-gallery {
        margin-bottom: 15px;
    }


    .photo-gallery .photo-thumb {
        position: relative;
    }

    .photo-gallery .photo-thumb img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .photo-gallery .photo-thumb .bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000;
        opacity: 0.3;
    }

    .photo-gallery .photo-thumb .icon {
        position: absolute;
        top: calc(50% - 20px);
        left: calc(50% - 20px);
    }

    .photo-gallery .photo-thumb .icon i {
        color: #fff;
        font-size: 24px;
        width: 44px;
        height: 44px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        border: 2px solid #fff;
    }



    .photo-gallery .photo-thumb .icon i {
        color: #fff;
        font-size: 24px;
        width: 44px;
        height: 44px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .photo-gallery .photo-caption,
    .photo-gallery .photo-caption a {
        margin-top: 10px;
        color: #000;
        font-weight: 700;
    }

    .photo-gallery .photo-caption,
    .photo-gallery .photo-caption a {
        margin-top: 10px;
        color: #000;
        font-weight: 700;
    }

    .photo-gallery .photo-caption,
    .photo-gallery .photo-caption a {
        margin-top: 10px;
        color: #000;
        font-weight: 700;
    }

    .photo-gallery .photo-date {
        color: #6d6d6d;
        font-size: 12px;
        margin-top: 10px;
        margin-bottom: 30px;
    }


    .news-font {
        font-size: 16px;
    }


    .be-comment-block {
        margin-bottom: 50px !important;
        border: 1px solid #edeff2;
        border-radius: 2px;
        padding: 50px 0;
        border: 1px solid #ffffff;
    }

    .comments-title {
        font-size: 16px;
        color: #262626;
        margin-bottom: 15px;
        font-family: 'Conv_helveticaneuecyr-bold';
    }

    .be-img-comment {
        width: 60px;
        height: 60px;
        float: left;
        margin-bottom: 15px;
    }

    .be-ava-comment {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .be-comment-content {
        margin-left: 80px;
    }

    .be-comment-content span {
        display: inline-block;
        width: 100%;
        margin-bottom: 15px;
    }

    .be-comment-name {
        font-size: 13px;
        font-family: 'Conv_helveticaneuecyr-bold';
    }

    .be-comment-content a {
        color: #383b43;
    }

    .be-comment-content span {
        display: inline-block;
        width: 100%;
        margin-bottom: 15px;
    }

    .be-comment-time {
        text-align: right;
    }

    .be-comment-time {
        font-size: 11px;
        color: #b4b7c1;
    }

    .be-comment-text {
        font-size: 13px;
        line-height: 18px;
        color: #7a8192;
        display: block;
        background: #f6f6f7;
        border: 1px solid #edeff2;
        padding: 15px 20px 20px 20px;
    }

    .form-group.fl_icon .icon {
        position: relative;
        top: 50px;
        left: 0;
        width: 48px;
        height: 48px;
        background: #f6f6f7;
        color: #b5b8c2;
        text-align: center;
        line-height: 50px;
        -webkit-border-top-left-radius: 2px;
        -webkit-border-bottom-left-radius: 2px;
        -moz-border-radius-topleft: 2px;
        -moz-border-radius-bottomleft: 2px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
    }

    .form-group .form-input {
        font-size: 13px;
        line-height: 50px;
        font-weight: 400;
        color: #b4b7c1;
        width: 100%;
        height: 50px;
        padding-left: 20px;
        padding-right: 20px;
        border: 1px solid #edeff2;
        border-radius: 3px;
    }

    .form-group.fl_icon .form-input {
        padding-left: 70px;
    }

    .form-group textarea.form-input {
        height: 150px;
    }


    .single-page-social a:nth-child(1) {
        background: #3b5998;
    }

    .single-page-social a {
        display: inline-block;
        color: #fff;
        font-weight: 400;
        font-size: 16px;
        margin-right: 3px;
        border-radius: 5px;
        transition: .8s all;
        padding: 7px 19px;
        border: 1px solid transparent;
    }

    .single-page-social a:nth-child(2) {
        background: #00acee;
    }

    .single-page-social a:nth-child(3) {
        background: #3b5998;
    }
</style>

<script>
    $(document).ready(function() {
        $('.magnific').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });

</script>    


@endsection

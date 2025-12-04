@extends('frontend.master')


@section('title')
    @if (session()->get('lang') == 'ru')
        {{ $gallery->title_ru }}
    @elseif(session()->get('lang') == 'en')
        {{ $gallery->title_en }}
    @else
        {{ $gallery->title_tj }}
    @endif
@endsection


@section('content')

<!-- Стиль masonry + анимации -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/lightgallery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/zoom/lg-zoom.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>

<style>
    .gallery-header {
        padding: 70px 0 40px;
        background: #f8fafc;
    }

    .gallery-title {
        font-size: 38px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .gallery-text {
        font-size: 18px;
        margin-top: 15px;
        color: #555;
        max-width: 800px;
    }

    /* Masonry */
    .masonry {
        column-count: 4;
        column-gap: 20px;
    }

    @media(max-width: 1200px){ .masonry { column-count: 3; } }
    @media(max-width: 768px){ .masonry { column-count: 2; } }
    @media(max-width: 500px){ .masonry { column-count: 1; } }

    .masonry-item {
        break-inside: avoid;
        margin-bottom: 20px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        cursor: zoom-in;
        transition: transform .3s;
    }

    .masonry-item:hover {
        transform: scale(1.02);
    }

    .masonry-item img {
        width: 100%;
        border-radius: 12px;
        display: block;
    }

    /* Fade animation */
    .fade-in {
        animation: fadeIn .7s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>




<!-- Banner Start -->
<section class="custom-banner">
    <div class="container">
        <div class="custom-banner-content">          
     
                 <h1 class="custom-banner-title text-left">
                @if (session()->get('lang') == 'ru')
                    {{ $gallery->title_ru }}
                @elseif(session()->get('lang') == 'en')
                    {{ $gallery->title_en }}
                @else
                    {{ $gallery->title_tj }}
                @endif
              </h1>

        </div>
    </div>
</section>
<!-- Banner End -->



<!-- Кнопка "Назад" -->
<section class="py-3 bg-light">
    <div class="container">
        <a href="{{ route('frontend.galleries') }}" class="text-decoration-none text-dark d-inline-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i>
           @if (session()->get('lang') == 'ru')
                Назад
            @elseif(session()->get('lang') == 'en')
                Back
            @else
               Баргаштан
            @endif
        </a>
    </div>
</section>


<!-- PHOTOS -->
<section class="py-5">
    <div class="container">

        <div id="lightgallery" class="masonry">

            @foreach ($gallery->images as $item)
                <a 
                    href="/upload/gallery/{{ $item->image }}" 
                    class="masonry-item fade-in"
                    data-sub-html="<h4>{{ $item->title_ru }}</h4>"
                >
                    <img src="/upload/gallery/{{ $item->image }}" alt="">
                </a>
            @endforeach

        </div>

    </div>
</section>



<script>
document.addEventListener("DOMContentLoaded", function () {
    lightGallery(document.getElementById('lightgallery'), {
        selector: '.masonry-item',
        zoom: true,
        thumbnail: true,
        download: false
    });
});
</script>

@endsection

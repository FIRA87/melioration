@extends('frontend.master')

@section('title')
  @trans('main_gallery')
@endsection



@section('content')


<section class="custom-banner py-5">
    <div class="container">
        <div class="text-left">
            <h1 class="custom-banner-title text-left">
             @trans('main_gallery')
            </h1>
        </div>
    </div>
</section>



<section class="py-5 bg-light">
    <div class="container">   

        <div class="row" id="masonry-grid" data-masonry='{"percentPosition": true }'>
            @foreach($galleries as $item)
                <div class="col-6 col-md-4 col-xl-3 mb-4 masonry-item">

                    <a href="/upload/cover/{{ $item->cover }}"
                       class="glightbox"
                       data-gallery="cover-gallery"
                       data-title="@if(session('lang')=='ru') {{ $item->title_ru }} @elseif(session('lang')=='en') {{ $item->title_en }} @else {{ $item->title_tj }} @endif">

                        <div class="rounded overflow-hidden shadow-sm hover-shadow-lg"
                             style="transition:.3s">

                            <img src="/upload/cover/{{ $item->cover }}"
                                 class="w-100"
                                 style="object-fit: cover;">

                        </div>
                    </a>

                    <a href="{{ url('gallery/details/'.$item->id) }}" class="text-decoration-none">
                        <h5 class="mt-2 text-dark">
                            @if(session('lang')=='ru') {{ $item->title_ru }}
                            @elseif(session('lang')=='en') {{ $item->title_en }}
                            @else {{ $item->title_tj }} @endif
                        </h5>
                    </a>

                </div>
            @endforeach
        </div>

    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    GLightbox({ selector: '.glightbox' });
});
</script>

@endsection

@extends('frontend.master')

@section('title')
    @if (session()->get('lang') == 'ru')
        {{ $prizent->title_ru }}
    @elseif(session()->get('lang') == 'en')
        {{ $prizent->title_en }}
    @else
        {{ $prizent->title_tj }}
    @endif
@endsection


@section('content')


<!-- Banner Start -->
<section class="custom-banner">
    <div class="container">
        <div class="custom-banner-content">          

           <h1 class="mb-4 fw-bold text-left" >
            @if (session()->get('lang') == 'ru')
                {{ $prizent->title_ru }}
            @elseif(session()->get('lang') == 'en')
                {{ $prizent->title_en }}
            @else
                {{ $prizent->title_tj }}
            @endif
        </h1>

        </div>
    </div>



</section>
<!-- Banner End -->


<div class="container py-5">   
        <img src="/{{ $prizent->image }}" class="img-fluid rounded shadow-sm mb-4" alt="{{ $prizent->title_ru }}">  


 
    <div class="project-text" style="font-size: 18px; line-height: 1.8;">
        @if (session()->get('lang') == 'ru')
            {!! $prizent->text_ru !!}
        @elseif(session()->get('lang') == 'en')
            {!! $prizent->text_en !!}
        @else
            {!! $prizent->text_tj !!}
        @endif
    </div>

</div>





@endsection

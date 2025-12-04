@extends('frontend.master')
@section('content')
@section('title')
    @if (session()->get('lang') == 'ru')
        {{ $submenu->title_ru }}
    @elseif(session()->get('lang') == 'en')
        {{ $submenu->title_en }}
    @else
        {{ $submenu->title_tj }}
    @endif
@endsection




<!-- Banner Start -->
<section class="custom-banner">
    <div class="container">
        <div class="custom-banner-content">          
        

               <h1 class="custom-banner-title text-left">
                    @if(session()->get('lang') == 'ru')
                        {!! $submenu->title_ru !!}
                    @elseif(session()->get('lang') == 'en')
                        {!! $submenu->title_en !!}
                    @else
                        {!! $submenu->title_tj !!}
                    @endif
                </h1>

        </div>
    </div>
</section>
<!-- Banner End -->


<section class="portfolio_details my-5">
    <div class="container">
        <div class="port_main">
            <div class="row">
                <div class="col-lg-12">
                    <div class="port_details_content">                       
                 
                        <p class="quote">
                            @if (session()->get('lang') == 'ru')
                                {!! $submenu->text_ru !!}
                            @elseif(session()->get('lang') == 'en')
                                {!! $submenu->text_en !!}                   
                            @else
                                {!! $submenu->text_tj !!}
                            @endif
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


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

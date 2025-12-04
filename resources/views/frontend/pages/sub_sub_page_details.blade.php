@extends('frontend.master')
@section('content')


@section('title')
    @if (session()->get('lang') == 'ru')
        Страница
    @elseif(session()->get('lang') == 'en')
        Саҳифа
    @else
        Page
    @endif
@endsection


  <div class="breadcrumb-area d-none d-md-block" style="display: none !important; ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_box text-left">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="/">
                                @if (session()->get('lang') == 'ru')
                                    Главная
                                @elseif(session()->get('lang') == 'en')
                                    Home
                                @elseif(session()->get('lang') == 'fr')
                                    Accueil
                                @elseif(session()->get('lang') == 'es')
                                    Inicio
                                @elseif(session()->get('lang') == 'ch')
                                    主页
                                @else
                                    Асосӣ
                                @endif
                            </a></li>/
                        <li><a href="{{ route('submenu.show', $submenu) }}">
                                @if (session()->get('lang') == 'ru')
                                    {!! $submenu->title_ru !!}
                                @elseif(session()->get('lang') == 'en')
                                    {!! $submenu->title_en !!}
                                @else
                                    {!! $submenu->title_tj !!}
                                @endif
                            </a></li>

                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
</div>


<section class="portfolio_details my-5">
    <div class="container">
        <div class="port_main">
            <div class="row">
                <div class="col-lg-12">
                    <div class="port_details_content">
                        <h2>
                            @if (session()->get('lang') == 'ru')
                                {{ $sub_submenu->title_ru }}
                            @elseif(session()->get('lang') == 'en')
                                {{ $sub_submenu->title_en }}
                            @elseif(session()->get('lang') == 'fr')
                                {{ $sub_submenu->title_fr }}
                            @elseif(session()->get('lang') == 'es')
                                {{ $sub_submenu->title_es }}
                            @elseif(session()->get('lang') == 'ch')
                                {{ $sub_submenu->title_ch }}
                            @else
                                {{ $sub_submenu->title_tj }}
                            @endif
                        </h2>
                        <p class="quote">
                            @if (session()->get('lang') == 'ru')
                                {!! $sub_submenu->text_ru !!}
                            @elseif(session()->get('lang') == 'en')
                                {!! $sub_submenu->text_en !!}
                            @elseif(session()->get('lang') == 'fr')
                                {!! $sub_submenu->text_fr !!}
                            @elseif(session()->get('lang') == 'es')
                                {!! $sub_submenu->text_es !!}
                            @elseif(session()->get('lang') == 'ch')
                                {!! $sub_submenu->text_ch !!}
                            @else
                                {!! $sub_submenu->text_tj !!}
                            @endif
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



@endsection

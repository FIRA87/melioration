<!-- Footer -->
<footer class="bg-light text-dark pt-5 pb-3">
    <div class="container">

        <!-- Верхняя часть футера: Логотипы и название -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6 d-flex align-items-center mb-3 mb-md-0 gap-3">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('frontend/img/vazorat.webp') }}" alt="logo1" class="rounded" style="width:60px; height:60px; object-fit:cover;">
                </a>
                <div>
                    <div class="fw-bold">
                     @if(session('lang') == 'ru') 
                        Министерство сельского хозяйства<br> Республики Таджикистан
                    @elseif(session('lang') == 'en')
                         Ministry of Agriculture of the<br> Republic of Tajikistan
                    @else
                        Вазорати кишоварзии<br> Ҷумҳурии Тоҷикистон

                    @endif
                    </div>
                
                </div>
            </div>

            <div class="col-md-6 d-flex align-items-center gap-3 justify-content-md-end">
                <a href="{{ url('/') }}">
                    <img src="{{'/'.  $siteSettings->logo }}" alt="logo2" class="rounded" style="width:60px; height:60px; object-fit:cover;">
                </a>
                <div>
                    <div class="fw-bold">
                        @if(session('lang') == 'ru') 
                            {!! $siteSettings->title_ru !!}
                        @elseif(session('lang') == 'en')
                             {!! $siteSettings->title_en !!}
                        @else
                            {!! $siteSettings->title_tj !!}
                        @endif
                    </div>
                    <small class="text-muted">
                      
                    </small>
                </div>
            </div>
        </div>

        <!-- Контакты -->
        <div class="row text-center text-md-start mb-4">
            <div class="col-md-2 mb-2">
                <i class="bi bi-envelope-fill me-2"></i> {{ $siteSettings->email }}
            </div>
            <div class="col-md-2 mb-2">
                <i class="bi bi-telephone-fill me-2"></i> {{ $siteSettings->phone }}
            </div>
            <div class="col-md-6 mb-2">
                <i class="bi bi-geo-alt-fill me-2"></i>
                @if(session('lang')=='ru') 
                    {{ $siteSettings->street_ru }}
                @elseif(session('lang')=='en') 
                    {{ $siteSettings->street_en }}             
                @else 
                    {{ $siteSettings->street_tj }}
                @endif
            </div>
        </div>

        <hr class="border-secondary">

        <!-- Нижняя часть футера -->
        <div class="text-center small text-muted">
            © 
            @if(session('lang') == 'ru') 
                {!! $siteSettings->title_ru !!}
            @elseif(session('lang') == 'en')
                 {!! $siteSettings->title_en !!}
            @else
                {!! $siteSettings->title_tj !!}
            @endif
        </div>
    </div>
</footer>

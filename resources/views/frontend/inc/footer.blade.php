<!-- Footer -->
<footer class="bg-light text-dark pt-5 pb-3">
    <div class="container">

    

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

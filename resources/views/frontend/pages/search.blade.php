@extends('frontend.master')

@section('title')
    {{ $lang = session()->get('lang') }}
    {{ $lang == 'ru' ? 'Поиск' : ($lang == 'en' ? 'Search' : 'Ҷустуҷӯ') }}
@endsection

@php
    $categories = App\Models\Category::orderBy('id', 'ASC')->get();
    $lang = session()->get('lang');
    $translations = [
        'search' => ['ru' => 'Поиск', 'en' => 'Search', 'tj' => 'Ҷустуҷӯ'],
        'search_results' => ['ru' => 'Результаты поиска', 'en' => 'Search Results', 'tj' => 'Натиҷаҳои ҷустуҷӯ'],
        'categories' => ['ru' => 'Категории', 'en' => 'Categories', 'tj' => 'Категорияҳо'],
        'read_more' => ['ru' => 'Читать далее', 'en' => 'Read more', 'tj' => 'Давомаш'],
        'not_found' => [
            'ru' => 'К сожалению, по вашему запросу ничего не найдено',
            'en' => 'Unfortunately, nothing was found for your request',
            'tj' => 'Мутаассифона, барои дархости шумо чизе ёфт нашуд'
        ],
        'try_different' => [
            'ru' => 'Попробуйте изменить поисковый запрос или выбрать другую категорию',
            'en' => 'Try changing your search query or select a different category',
            'tj' => 'Кӯшиш кунед дархости худро тағйир диҳед ё категорияи дигареро интихоб намоед'
        ],
        'placeholder' => ['ru' => 'Введите запрос...', 'en' => 'Enter query...', 'tj' => 'Дархостро ворид кунед...'],
        'results_count' => ['ru' => 'Найдено результатов:', 'en' => 'Results found:', 'tj' => 'Натиҷаҳо ёфт шуданд:'],
        'all_categories' => ['ru' => 'Все категории', 'en' => 'All categories', 'tj' => 'Ҳамаи категорияҳо']
    ];
@endphp

@section('content')
<!-- Modern Search Banner -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold text-white mb-4">
                    {{ $translations['search_results'][$lang] ?? $translations['search_results']['tj'] }}
                </h1>
                
                <!-- Enhanced Search Form -->
                <form action="{{ route('news.search') }}" method="POST" class="position-relative">
                    @csrf
                    <div class="input-group input-group-lg shadow-lg" style="border-radius: 50px; overflow: hidden;">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control border-0 px-4" 
                            placeholder="{{ $translations['placeholder'][$lang] ?? $translations['placeholder']['tj'] }}"
                            value="{{ request('search') }}"
                            style="height: 60px; font-size: 1.1rem;"
                            required
                        >
                        <button 
                            type="submit" 
                            class="btn btn-primary px-5 border-0" 
                            style="background: #667eea;"
                        >
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Results Section -->
<section class="py-5 bg-light">
    <div class="container">
        @php
            $news = $lang == 'ru' ? $news_ru : ($lang == 'en' ? $news_en : $news_tj);
            $title_field = "title_$lang";
            $details_field = "news_details_$lang";
            $category_field = "title_$lang";
        @endphp

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-12">
                @if($news->isNotEmpty())
                    <!-- Results Count -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="text-muted mb-0">
                            {{ $translations['results_count'][$lang] ?? $translations['results_count']['tj'] }}
                            <span class="badge bg-primary rounded-pill ms-2">{{ $news->count() }}</span>
                        </h5>
                    </div>

                    <!-- News Cards -->
                    <div class="row g-4">
                        @foreach($news as $item)
                            <div class="col-12 col-md-4">
                                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden hover-lift" 
                                     style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    
                                    <!-- Image -->
                                    <div class="position-relative overflow-hidden" style="height: 220px;">
                                        @if($item->images && $item->images->isNotEmpty())
                                            <img 
                                                src="{{ asset($item->images->first()->image) }}" 
                                                class="card-img-top w-100 h-100" 
                                                style="object-fit: cover; transition: transform 0.3s ease;"
                                                alt="{{ $item->$title_field }}"
                                                onmouseover="this.style.transform='scale(1.05)'"
                                                onmouseout="this.style.transform='scale(1)'"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('upload/no-image.jpg') }}" 
                                                class="card-img-top w-100 h-100" 
                                                style="object-fit: cover;"
                                                alt="No image"
                                            >
                                        @endif
                                        <div class="position-absolute bottom-0 start-0 end-0" 
                                             style="height: 40%; background: linear-gradient(transparent, rgba(0,0,0,0.7));"></div>
                                    </div>

                                    <!-- Content -->
                                    <div class="card-body d-flex flex-column p-4">
                                        <!-- Meta Info -->
                                        <div class="d-flex align-items-center text-muted small mb-3">
                                            <i class="bi bi-calendar3 me-2"></i>
                                            <span>{{ $item->publish_date ? date('d.m.Y', strtotime($item->publish_date)) : date('d.m.Y', strtotime($item->created_at)) }}
</span>
                                        </div>

                                        <!-- Title -->
                                        <h5 class="fw-bold mb-3" style="line-height: 1.4;">
                                            <a href="{{ url('news/details/'.$item->id) }}" 
                                               class="text-dark text-decoration-none stretched-link"
                                               style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                {{ $item->$title_field }}
                                            </a>
                                        </h5>

                                        <!-- Excerpt -->
                                        <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                                            {!! Str::limit(strip_tags($item->$details_field ?? ''), 100) !!}
                                        </p>

                                        <!-- Read More -->
                                        <div class="mt-auto">
                                            <span class="text-primary fw-semibold" style="font-size: 0.95rem;">
                                                {{ $translations['read_more'][$lang] ?? $translations['read_more']['tj'] }}
                                                <i class="bi bi-arrow-right ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-search text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                        </div>
                        <h3 class="fw-bold mb-3">
                            {{ $translations['not_found'][$lang] ?? $translations['not_found']['tj'] }}
                        </h3>
                        <p class="text-muted mb-4">
                            {{ $translations['try_different'][$lang] ?? $translations['try_different']['tj'] }}
                        </p>
                        <a href="{{ url('/') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-house-door me-2"></i>На главную
                        </a>
                    </div>
                @endif
            </div>

      
        </div>
    </div>
</section>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
}

.list-group-item:hover {
    background-color: #f8f9fa !important;
    padding-left: 1.25rem !important;
}

.stretched-link:hover {
    color: #667eea !important;
}

/* Search input focus effect */
.form-control:focus {
    box-shadow: none;
    border-color: transparent;
}

/* Smooth animations */
.card, .list-group-item {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
@endsection
@if($news->count() > 0)
    <div class="row g-4">
        @foreach($news as $item)
        <div class="col-12 col-md-4 news-card">
            <article class="card border-0 shadow-sm h-100">
                <div class="position-relative overflow-hidden" style="height: 240px;">
                    @if(!empty($item->image) && $item->image !== 'no-image.jpg')
                        <img src="{{ asset($item->image) }}" class="w-100 h-100 object-fit-cover news-image" alt="News">
                    @else
                        <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                            <i class="bi bi-image text-white" style="font-size: 4rem; opacity:0.3;"></i>
                        </div>
                    @endif
                    <div class="position-absolute bottom-0 start-0 m-3">
                        <span class="badge bg-white text-dark px-3 py-2 shadow-sm">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ \Carbon\Carbon::parse($item->publish_date ?? $item->created_at)->format('d.m.Y') }}
                        </span>
                    </div>
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title fw-bold mb-3" style="min-height:60px; line-height:1.4;">
                        <a href="{{ url('news/details/'.$item->id) }}" class="text-decoration-none text-dark stretched-link">
                            @if(session()->get('lang')=='ru') {{ Str::limit($item->title_ru,70) }}
                            @elseif(session()->get('lang')=='en') {{ Str::limit($item->title_en,70) }}
                            @else {{ Str::limit($item->title_tj,70) }} @endif
                        </a>
                    </h5>
                    <p class="card-text text-muted small mb-3 flex-grow-1">
                        @if(session()->get('lang')=='ru') {{ Str::limit(strip_tags($item->news_details_ru ?? ''),100) }}
                        @elseif(session()->get('lang')=='en') {{ Str::limit(strip_tags($item->news_details_en ?? ''),100) }}
                        @else {{ Str::limit(strip_tags($item->news_details_tj ?? ''),100) }} @endif
                    </p>
                    <div class="mt-auto">
                        <span class="text-primary fw-semibold small">
                            @if(session()->get('lang')=='ru') Читать больше...
                            @elseif(session()->get('lang')=='en') Read more...
                            @else Бештар хондан... @endif
                        </span>
                    </div>
                </div>
            </article>
        </div>
        @endforeach
    </div>

    {{-- Пагинация --}}
    <div class="mt-4">
        {{ $news->links() }}
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-folder-x" style="font-size:4rem; color:#ccc;"></i>
        <h4 class="mt-3 text-muted">
            @if(session()->get('lang')=='ru') Новости не найдены
            @elseif(session()->get('lang')=='en') No news found
            @else Хабарҳо ёфт нашуданд @endif
        </h4>
    </div>
@endif

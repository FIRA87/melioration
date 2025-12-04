@extends('frontend.master')

@section('title')
    @if(session()->get('lang') == 'ru')
        {{ $news->title_ru ?? 'Новость' }}
    @elseif(session()->get('lang') == 'en')
        {{ $news->title_en ?? 'News' }}
    @else
        {{ $news->title_tj ?? 'Хабар' }}
    @endif
@endsection

@section('content')

<!-- Кнопка "Назад" -->
<section class="py-3 bg-light">
    <div class="container">
        <a href="{{ route('frontend.news') }}" class="text-decoration-none text-dark d-inline-flex align-items-left">
            <i class="bi bi-arrow-left me-2"></i>
            @if(session()->get('lang') == 'ru')
                Все новости
            @elseif(session()->get('lang') == 'en')
                All News
            @else
                Ҳамаи хабарҳо
            @endif
        </a>
    </div>
</section>

<!-- Основной контент новости -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">
                
                <!-- Главное изображение -->
                @if(!empty($news->image) && $news->image !== '404.jpg')
                    <div class="mb-4">
                        <img src="{{ asset($news->image) }}"
                             class="img-fluid w-100 rounded-3 shadow-sm"
                             alt="News"
                             style="max-height: 500px; object-fit: cover;">
                    </div>
                @endif

                <!-- Заголовок -->
                <h1 class="fw-bold mb-4" style="font-size: 1.75rem; line-height: 1.4;">
                    @if(session()->get('lang') == 'ru')
                        {{ $news->title_ru }}
                    @elseif(session()->get('lang') == 'en')
                        {{ $news->title_en }}
                    @else
                        {{ $news->title_tj }}
                    @endif
                </h1>

                <!-- Дата публикации -->
                <p class="text-muted mb-4">
                    {{ \Carbon\Carbon::parse($news->publish_date ?? $news->created_at)->locale(session('lang') == 'ru' ? 'ru' : 'en')->isoFormat('D MMMM YYYY') }}
                </p>

                <!-- Текст новости -->
                <div class="news-content mb-5" style="font-size: 1rem; line-height: 1.8; color: #333;">
                    @if(session()->get('lang') == 'ru')
                        {!! $news->news_details_ru !!}
                    @elseif(session()->get('lang') == 'en')
                        {!! $news->news_details_en !!}
                    @else
                        {!! $news->news_details_tj !!}
                    @endif
                </div>

                <!-- Галерея дополнительных изображений -->
                @if($news->images && $news->images->count() > 0)
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4">
                            @if(session()->get('lang') == 'ru')
                                Фотогалерея
                            @elseif(session()->get('lang') == 'en')
                                Photo Gallery
                            @else
                                Галереяи аксҳо
                            @endif
                        </h4>

                        <!-- Карусель Bootstrap -->
                        <div id="newsGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                            <!-- Индикаторы -->
                            <div class="carousel-indicators">
                                @foreach($news->images as $index => $image)
                                    <button type="button" 
                                            data-bs-target="#newsGalleryCarousel" 
                                            data-bs-slide-to="{{ $index }}" 
                                            class="{{ $index === 0 ? 'active' : '' }}"
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>

                            <!-- Слайды -->
                            <div class="carousel-inner rounded-3 shadow">
                                @foreach($news->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset($image->image) }}" 
     class="d-block w-100 gallery-image" 
     alt="Gallery Image {{ $index + 1 }}"
     style="max-height: 500px; object-fit: contain; background-color: #f8f9fa;"
     data-bs-toggle="modal"
     data-bs-target="#imageModal"
     data-image="{{ asset($image->image) }}">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Кнопки навигации -->
                            @if($news->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#newsGalleryCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#newsGalleryCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>

                        <!-- Миниатюры -->
                        @if($news->images->count() > 1)
                            <div class="row g-2 mt-3">
                                @foreach($news->images as $index => $image)
                                    <div class="col-2 col-md-1-5">
                                        <img src="{{ asset($image->image) }}" 
                                             class="img-thumbnail gallery-thumb" 
                                             alt="Thumbnail {{ $index + 1 }}"
                                             style="cursor: pointer; height: 80px; object-fit: cover;"
                                             data-bs-target="#newsGalleryCarousel" 
                                             data-bs-slide-to="{{ $index }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>

<!-- Модальное окно для полноэкранного просмотра -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1050;"></button>
                <img id="modalImage" src="" class="img-fluid w-100 rounded" alt="Full Image">
            </div>
        </div>
    </div>
</div>


<hr>
        <!-- Другие новости -->
        @if(isset($related_news) && $related_news->count() > 0)
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-lg-12">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0">
                            @if(session()->get('lang') == 'ru')
                                Другие новости
                            @elseif(session()->get('lang') == 'en')
                                Other News
                            @else
                                Дигар хабарҳо
                            @endif
                        </h3>
                        
                        <!-- Стрелки навигации -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary btn-sm rounded-circle" 
                                    id="prevBtn" 
                                    style="width: 36px; height: 36px; padding: 0;">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary btn-sm rounded-circle" 
                                    id="nextBtn"
                                    style="width: 36px; height: 36px; padding: 0;">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>



                    <!-- Карусель новостей -->
                    <div class="position-relative overflow-hidden">
                        <div class="news-carousel d-flex gap-3" id="newsCarousel">
                            @foreach($related_news->take(12) as $item)
                                <div class="news-item flex-shrink-0" style="width: 280px;">
                                    <a href="{{ url('news/details/'.$item->id) }}" 
                                       class="text-decoration-none">
                                        <div class="card border-0 shadow-sm h-100 hover-card">
                                            <!-- Изображение -->
                                            <div class="position-relative overflow-hidden" style="height: 180px;">
                                                @if(!empty($item->image) && $item->image !== 'no-image.jpg')
                                                    <img src="{{ asset($item->image) }}"
                                                         class="w-100 h-100 object-fit-cover news-image"
                                                         alt="News">
                                                @else
                                                    <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-image text-white" style="font-size: 3rem; opacity: 0.3;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Контент -->
                                            <div class="card-body p-3">
                                                <small class="text-muted d-block mb-2">
                                                    {{ \Carbon\Carbon::parse($item->publish_date ?? $item->created_at)->format('d.m.Y') }}
                                                </small>
                                                <h6 class="fw-bold text-dark mb-2" style="line-height: 1.4; min-height: 45px;">
                                                    @if(session()->get('lang') == 'ru')
                                                        {{ Str::limit($item->title_ru, 65) }}
                                                    @elseif(session()->get('lang') == 'en')
                                                        {{ Str::limit($item->title_en, 65) }}
                                                    @else
                                                        {{ Str::limit($item->title_tj, 65) }}
                                                    @endif
                                                </h6>
                                                <p class="text-primary small mb-0">
                                                    @if(session()->get('lang') == 'ru')
                                                        Читать больше...
                                                    @elseif(session()->get('lang') == 'en')
                                                        Read more...
                                                    @else
                                                        Бештар хондан...
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Точки пагинации -->
                    <div class="d-flex justify-content-center gap-2 mt-4" id="pagination">
                        <!-- Генерируются автоматически через JS -->
                    </div>

                </div>
            </div>
        @endif
    </div>
</section>

<style>
    /* Контент новости */
    .news-content p {
        margin-bottom: 1.2rem;
        text-align: justify;
    }

    .news-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .news-content h2, 
    .news-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }

    /* Карусель */
    .news-carousel {
        scroll-behavior: smooth;
        transition: transform 0.4s ease;
    }

    .news-item {
        transition: opacity 0.3s ease;
    }

    /* Hover эффект для карточек */
    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    }

    .news-image {
        transition: transform 0.4s ease;
    }

    .hover-card:hover .news-image {
        transform: scale(1.1);
    }

    .object-fit-cover {
        object-fit: cover;
    }

    /* Точки пагинации */
    .pagination-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #dee2e6;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .pagination-dot.active {
        background-color: #0d6efd;
        width: 24px;
        border-radius: 4px;
    }

    /* Кнопки навигации */
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .news-item {
            width: 240px !important;
        }
        
        h1 {
            font-size: 1.5rem !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('newsCarousel');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const pagination = document.getElementById('pagination');
        
        if (!carousel) return;
        
        const items = carousel.querySelectorAll('.news-item');
        const itemWidth = 280 + 12; // ширина + gap
        const visibleItems = Math.floor(carousel.parentElement.offsetWidth / itemWidth);
        const totalPages = Math.ceil(items.length / visibleItems);
        let currentPage = 0;

        // Создаем точки пагинации
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('div');
            dot.className = 'pagination-dot' + (i === 0 ? ' active' : '');
            dot.addEventListener('click', () => goToPage(i));
            pagination.appendChild(dot);
        }

        function updatePagination() {
            const dots = pagination.querySelectorAll('.pagination-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentPage);
            });
        }

        function goToPage(page) {
            currentPage = Math.max(0, Math.min(page, totalPages - 1));
            const scrollAmount = currentPage * itemWidth * visibleItems;
            carousel.style.transform = `translateX(-${scrollAmount}px)`;
            updatePagination();
        }

        prevBtn.addEventListener('click', () => {
            goToPage(currentPage - 1);
        });

        nextBtn.addEventListener('click', () => {
            goToPage(currentPage + 1);
        });

        // Адаптивность при изменении размера окна
        window.addEventListener('resize', () => {
            goToPage(0);
        });
		
		   // Обработчик для модального окна с изображением
    const imageModal = document.getElementById('imageModal');
    if (imageModal) {
        imageModal.addEventListener('show.bs.modal', function (event) {
            const trigger = event.relatedTarget; // Элемент, который вызвал модальное окно
            const imageUrl = trigger.getAttribute('data-image');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
        });
    }
    });
</script>

@endsection
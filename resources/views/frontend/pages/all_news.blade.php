@extends('frontend.master')

@section('title')
    @trans('main_news')
@endsection

@section('content')

<section class="custom-banner py-5">
    <div class="container text-left">
        <h1 class="custom-banner-title text-left">  @trans('main_news')   </h1>
    </div>
</section>

<div class="container py-5">
    {{-- Фильтр --}}
    <div class="filter-panel mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-bold">
                   @trans('search_news')
                 </label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="@if(session()->get('lang')=='ru')Введите текст...@elseif(session()->get('lang')=='en')Enter text...@else Матнро ворид кунед...@endif">
                </div>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-bold">
                    @if(session()->get('lang') == 'ru')
                     Дата от 
                    @elseif(session()->get('lang') == 'en') 
                      Date from 
                    @else 
                      Аз сана
                    @endif
             </label>
                <input type="date" id="dateFrom" class="form-control form-control-lg">
            </div>

            <div class="col-md-2">
                <label class="form-label fw-bold">
                    @if(session()->get('lang') == 'ru') 
                        Дата до
                    @elseif(session()->get('lang') == 'en') 
                        Date to 
                    @else 
                        То сана 
                    @endif
                 </label>
                <input type="date" id="dateTo" class="form-control form-control-lg">
            </div>

            <div class="col-md-2 d-grid">
                <button type="button" class="btn btn-outline-secondary" id="resetFilters">
                    <i class="bi bi-arrow-clockwise me-1"></i>
                    @if(session()->get('lang')=='ru')
                        Сбросить
                    @elseif(session()->get('lang')=='en')
                        Reset
                    @else 
                        Тоза кардан
                    @endif
                </button>
            </div>
        </div>
    </div>

    {{-- Новости --}}
    <div id="newsGrid">
        @include('frontend.pages.partials.news_list', ['news' => $news])
    </div>
</div>

<style>
    .news-card { transition: all 0.3s ease; }
    .news-card:hover { transform: translateY(-8px); box-shadow:0 12px 28px rgba(0,0,0,0.15) !important; }
    .news-image { transition: transform 0.4s ease; }
    .news-card:hover .news-image { transform: scale(1.08); }
    .object-fit-cover { object-fit: cover; }
    .filter-panel { background: #f8f9fa; padding: 25px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
    .pagination .page-link { border-radius: 8px; margin: 0 3px; border: 1px solid #dee2e6; color: #333; font-weight: 500; }
    .pagination .page-item.active .page-link { background-color: #0d6efd; border-color: #0d6efd; color: #fff; }
    .pagination .page-link:hover { background-color: #f8f9fa; border-color: #0d6efd; color: #0d6efd; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const dateFrom = document.getElementById('dateFrom');
    const dateTo = document.getElementById('dateTo');
    const resetButton = document.getElementById('resetFilters');
    const newsGrid = document.getElementById('newsGrid');

    function fetchNews(page = 1) {
        const params = new URLSearchParams({
            search: searchInput.value,
            date_from: dateFrom.value,
            date_to: dateTo.value,
            page: page
        });

        fetch(`/news?${params.toString()}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text())
            .then(html => {
                newsGrid.innerHTML = html;
                newsGrid.querySelectorAll('.pagination a').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = new URL(this.href);
                        const newPage = url.searchParams.get('page') || 1;
                        fetchNews(newPage);
                    });
                });
            });
    }

    searchInput.addEventListener('input', () => setTimeout(fetchNews, 300));
    dateFrom.addEventListener('change', fetchNews);
    dateTo.addEventListener('change', fetchNews);
    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        dateFrom.value = '';
        dateTo.value = '';
        fetchNews();
    });
});
</script>

@endsection

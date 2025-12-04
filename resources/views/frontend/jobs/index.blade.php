@extends('frontend.master')
@section('title')
    @if(session()->get('lang') == 'ru')
        Вакансии
    @elseif(session()->get('lang') == 'en')
        Vacancies
    @else
        Ҷойҳои кории холӣ
    @endif
@endsection


@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">
                @if(session()->get('lang') == 'ru')
                    Вакансии
                @elseif(session()->get('lang') == 'en')
                    Vacancies
                @else
                    Ҷойҳои кории холӣ
                @endif
            </h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($jobs->isEmpty())
                <div class="alert alert-info">
                    @if(session()->get('lang') == 'ru')
                        В данный момент нет активных вакансий
                    @elseif(session()->get('lang') == 'en')
                        There are no active vacancies at the moment
                    @else
                        Дар ин лаҳза ҷойҳои кории фаъол нест
                    @endif
                </div>
            @else
                <!-- Фильтры -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Поиск -->
                            <div class="col-md-4">
                                <label for="searchInput" class="form-label">
                                    <i class="bi bi-search"></i>
                                    @if(session()->get('lang') == 'ru')
                                        Поиск
                                    @elseif(session()->get('lang') == 'en')
                                        Search
                                    @else
                                        Ҷустуҷӯ
                                    @endif
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="searchInput" 
                                       placeholder="@if(session()->get('lang') == 'ru')Введите название или местоположение...@elseif(session()->get('lang') == 'en')Enter title or location...@elseНом ё ҷойгиршавиро ворид кунед...@endif">
                            </div>

                            <!-- Фильтр по местоположению -->
                            <div class="col-md-3">
                                <label for="locationFilter" class="form-label">
                                    <i class="bi bi-geo-alt"></i>
                                    @if(session()->get('lang') == 'ru')
                                        Местоположение
                                    @elseif(session()->get('lang') == 'en')
                                        Location
                                    @else
                                        Ҷойгиршавӣ
                                    @endif
                                </label>
                                <select class="form-select" id="locationFilter">
                                    <option value="all">
                                        @if(session()->get('lang') == 'ru')
                                            Все локации
                                        @elseif(session()->get('lang') == 'en')
                                            All locations
                                        @else
                                            Ҳамаи ҷойҳо
                                        @endif
                                    </option>
                                    @php
                                        $locations = $jobs->pluck('location')->unique()->filter();
                                    @endphp
                                    @foreach($locations as $location)
                                        <option value="{{ $location }}">{{ $location }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Сортировка -->
                            <div class="col-md-3">
                                <label for="sortFilter" class="form-label">
                                    <i class="bi bi-sort-down"></i>
                                    @if(session()->get('lang') == 'ru')
                                        Сортировка
                                    @elseif(session()->get('lang') == 'en')
                                        Sort
                                    @else
                                        Мураттабсозӣ
                                    @endif
                                </label>
                                <select class="form-select" id="sortFilter">
                                    <option value="desc">
                                        @if(session()->get('lang') == 'ru')
                                            Сначала новые
                                        @elseif(session()->get('lang') == 'en')
                                            Newest first
                                        @else
                                            Аввал навтарҳо
                                        @endif
                                    </option>
                                    <option value="asc">
                                        @if(session()->get('lang') == 'ru')
                                            Сначала старые
                                        @elseif(session()->get('lang') == 'en')
                                            Oldest first
                                        @else
                                            Аввал кӯҳнатарҳо
                                        @endif
                                    </option>
                                    <option value="salary">
                                        @if(session()->get('lang') == 'ru')
                                            По зарплате
                                        @elseif(session()->get('lang') == 'en')
                                            By salary
                                        @else
                                            Аз рӯи музди меҳнат
                                        @endif
                                    </option>
                                </select>
                            </div>

                            <!-- Кнопка сброса -->
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-secondary w-100" id="resetFilters">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    @if(session()->get('lang') == 'ru')
                                        Сбросить
                                    @elseif(session()->get('lang') == 'en')
                                        Reset
                                    @else
                                        Тоза кардан
                                    @endif
                                </button>
                            </div>
                        </div>

                        <!-- Счетчик результатов -->
                        <div class="mt-3">
                            <p class="text-muted mb-0" id="resultsCount"></p>
                        </div>
                    </div>
                </div>

                <!-- Сетка вакансий -->
                <div class="row" id="jobsGrid">
                    @foreach($jobs as $job)
                        <div class="col-md-6 col-lg-4 mb-4 job-card"
                             data-title-ru="{{ $job->title_ru ?? '' }}"
                             data-title-en="{{ $job->title_en ?? '' }}"
                             data-title-tj="{{ $job->title_tj ?? '' }}"
                             data-desc-ru="{{ $job->description_ru ?? '' }}"
                             data-desc-en="{{ $job->description_en ?? '' }}"
                             data-desc-tj="{{ $job->description_tj ?? '' }}"
                             data-location="{{ $job->location ?? '' }}"
                             data-salary="{{ $job->salary ?? '' }}"
                             data-date="{{ $job->created_at }}"
                             style="transition: all 0.3s ease; opacity: 1; transform: scale(1);">
                            <div class="card h-100 shadow-sm hover-shadow">
                                @if($job->image)
                                    <img src="{{ asset($job->image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $job->{'title_'.app()->getLocale()} }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $job->{'title_'.app()->getLocale()} }}</h5>
                                    
                                    @if($job->location)
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-map-marker-alt"></i> {{ $job->location }}
                                        </p>
                                    @endif

                                    @if($job->salary)
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-money-bill-wave"></i> {{ $job->salary }}
                                        </p>
                                    @endif

                                    @if($job->end_date)
                                        <p class="text-muted mb-3">
                                            <i class="fas fa-calendar"></i> 
                                            @if(session()->get('lang') == 'ru')
                                                До
                                            @elseif(session()->get('lang') == 'en')
                                                Until
                                            @else
                                                То
                                            @endif: {{ $job->end_date->format('d.m.Y') }}
                                        </p>
                                    @endif

                                    <div class="mt-auto">
                                        <a href="{{ route('frontend.jobs.show', $job->slug) }}" class="btn btn-primary btn-sm me-2" style="color: #fff !important;">
                                            @if(session()->get('lang') == 'ru')
                                                Подробнее
                                            @elseif(session()->get('lang') == 'en')
                                                Details
                                            @else
                                                Муфассал
                                            @endif
                                        </a>
                                        <a href="{{ route('frontend.jobs.apply', $job->slug) }}" class="btn btn-success btn-sm" style="color: #fff !important;">
                                            @if(session()->get('lang') == 'ru')
                                                Подать заявку
                                            @elseif(session()->get('lang') == 'en')
                                                Apply
                                            @else
                                                Аризадиҳӣ
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Сообщение об отсутствии результатов -->
                <div id="noResults" style="display: none;" class="text-center py-5">
                    <i class="bi bi-search" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3 text-muted">
                        @if(session()->get('lang') == 'ru')
                            Ничего не найдено
                        @elseif(session()->get('lang') == 'en')
                            No results found
                        @else
                            Ҳеҷ чиз ёфт нашуд
                        @endif
                    </h4>
                    <p class="text-muted">
                        @if(session()->get('lang') == 'ru')
                            Попробуйте изменить параметры поиска
                        @elseif(session()->get('lang') == 'en')
                            Try changing your search criteria
                        @else
                            Параметрҳои ҷустуҷӯро тағйир диҳед
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .job-card.hiding {
        opacity: 0 !important;
        transform: scale(0.95) !important;
    }

    .card-img-top {
        border-radius: 0.375rem 0.375rem 0 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const locationFilter = document.getElementById('locationFilter');
        const sortFilter = document.getElementById('sortFilter');
        const resetButton = document.getElementById('resetFilters');
        const jobCards = document.querySelectorAll('.job-card');
        const resultsCount = document.getElementById('resultsCount');
        const noResults = document.getElementById('noResults');
        const jobsGrid = document.getElementById('jobsGrid');

        function filterJobs() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const locationValue = locationFilter.value;
            const sortValue = sortFilter.value;
            let visibleCards = [];

            jobCards.forEach(card => {
                const titleRu = (card.getAttribute('data-title-ru') || '').toLowerCase();
                const titleEn = (card.getAttribute('data-title-en') || '').toLowerCase();
                const titleTj = (card.getAttribute('data-title-tj') || '').toLowerCase();
                const descRu = (card.getAttribute('data-desc-ru') || '').toLowerCase();
                const descEn = (card.getAttribute('data-desc-en') || '').toLowerCase();
                const descTj = (card.getAttribute('data-desc-tj') || '').toLowerCase();
                const location = card.getAttribute('data-location') || '';
                const salary = (card.getAttribute('data-salary') || '').toLowerCase();

                const matchesSearch = !searchTerm || 
                                      titleRu.includes(searchTerm) || 
                                      titleEn.includes(searchTerm) || 
                                      titleTj.includes(searchTerm) ||
                                      descRu.includes(searchTerm) ||
                                      descEn.includes(searchTerm) ||
                                      descTj.includes(searchTerm) ||
                                      salary.includes(searchTerm);

                const matchesLocation = locationValue === 'all' || location === locationValue;

                if (matchesSearch && matchesLocation) {
                    card.classList.remove('hiding');
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    }, 10);
                    visibleCards.push(card);
                } else {
                    card.classList.add('hiding');
                    setTimeout(() => {
                        if (card.classList.contains('hiding')) {
                            card.style.display = 'none';
                        }
                    }, 300);
                }
            });

            // Сортировка
            visibleCards.sort((a, b) => {
                if (sortValue === 'salary') {
                    const salaryA = a.getAttribute('data-salary') || '';
                    const salaryB = b.getAttribute('data-salary') || '';
                    return salaryB.localeCompare(salaryA);
                } else {
                    const dateA = new Date(a.getAttribute('data-date'));
                    const dateB = new Date(b.getAttribute('data-date'));
                    return sortValue === 'asc' ? dateA - dateB : dateB - dateA;
                }
            });

            visibleCards.forEach(card => jobsGrid.appendChild(card));

            updateResultsCount(visibleCards.length);

            noResults.style.display = visibleCards.length === 0 ? 'block' : 'none';
        }

        function updateResultsCount(count) {
            const lang = '{{ session()->get("lang") ?? "tj" }}';
            const total = jobCards.length;
            let text = '';
            if (lang === 'ru') {
                text = `Показано: <strong>${count}</strong> из <strong>${total}</strong> вакансий`;
            } else if (lang === 'en') {
                text = `Showing: <strong>${count}</strong> of <strong>${total}</strong> vacancies`;
            } else {
                text = `Намоиш дода шудааст: <strong>${count}</strong> аз <strong>${total}</strong> ҷойҳои корӣ`;
            }
            resultsCount.innerHTML = text;
        }

        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(filterJobs, 300);
        });

        locationFilter.addEventListener('change', filterJobs);
        sortFilter.addEventListener('change', filterJobs);

        resetButton.addEventListener('click', function() {
            searchInput.value = '';
            locationFilter.value = 'all';
            sortFilter.value = 'desc';
            filterJobs();
            
            const lang = '{{ session()->get("lang") ?? "tj" }}';
            let resetText = '';
            if (lang === 'ru') {
                resetButton.innerHTML = '<i class="bi bi-check me-1"></i>Сброшено';
            } else if (lang === 'en') {
                resetButton.innerHTML = '<i class="bi bi-check me-1"></i>Reset';
            } else {
                resetButton.innerHTML = '<i class="bi bi-check me-1"></i>Тоза карда шуд';
            }
            
            setTimeout(() => {
                if (lang === 'ru') {
                    resetButton.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i>Сбросить';
                } else if (lang === 'en') {
                    resetButton.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i>Reset';
                } else {
                    resetButton.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i>Тоза кардан';
                }
            }, 2000);
        });

        // Инициализация при загрузке
        filterJobs();
    });
</script>
@endsection
@extends('frontend.master')
@section('title')
    @if (session()->get('lang') == 'ru')
        Все проекты
    @elseif(session()->get('lang') == 'en')
        All Projects
    @else
        Ҳамаи лоиҳаҳо
    @endif
@endsection
@section('content')
<!-- Баннер -->
<section class="custom-banner py-5">
    <div class="container">
        <div class="text-left">
            <h1 class="custom-banner-title text-left">
                  @if (session()->get('lang') == 'ru')
                        Наши проекты
                    @elseif(session()->get('lang') == 'en')
                        Our Projects
                    @else
                        Лоиҳаҳои мо
                    @endif
            </h1>
        </div>
    </div>
</section>

<div class="container py-5">
    {{-- Панель фильтрации и поиска --}}
    <div class="filter-panel mb-4">
        <div class="row g-3 align-items-end">
            {{-- Поиск --}}
            <div class="col-lg-6 col-md-6">
                <label for="searchInput" class="form-label fw-bold">
                    @if (session()->get('lang') == 'ru')
                        Поиск по ключевым словам
                    @elseif(session()->get('lang') == 'en')
                        Search by keywords
                    @else
                        Ҷустуҷӯ бо калимаҳои калидӣ
                    @endif
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" 
                           class="form-control border-start-0 ps-0" 
                           id="searchInput" 
                           placeholder="@if (session()->get('lang') == 'ru')Введите название проекта...@elseif(session()->get('lang') == 'en')Enter project name...@elseХат кунед номи лоиҳа...@endif">
                </div>
                
            </div>

            {{-- Фильтр по статусу --}}
            <div class="col-lg-4 col-md-4">
                <label for="statusFilter" class="form-label fw-bold">
                    @if (session()->get('lang') == 'ru')
                        Статус проекта
                    @elseif(session()->get('lang') == 'en')
                        Project Status
                    @else
                        Ҳолати лоиҳа
                    @endif
                </label>
                <select class="form-select" id="statusFilter">
                    <option value="all">
                        @if (session()->get('lang') == 'ru')
                            Все проекты
                        @elseif(session()->get('lang') == 'en')
                            All Projects
                        @else
                            Ҳамаи лоиҳаҳо
                        @endif
                    </option>
                    <option value="active">
                        @if (session()->get('lang') == 'ru')
                            Активные
                        @elseif(session()->get('lang') == 'en')
                            Active
                        @else
                            Фаъол
                        @endif
                    </option>
                    <option value="completed">
                        @if (session()->get('lang') == 'ru')
                            Завершенные
                        @elseif(session()->get('lang') == 'en')
                            Completed
                        @else
                            Анҷомёфта
                        @endif
                    </option>
                </select>
            </div>

            {{-- Кнопка сброса --}}
            <div class="col-lg-2 col-md-2">
                <button type="button" class="btn btn-outline-secondary w-100" id="resetFilters">
                    <i class="bi bi-arrow-clockwise me-1"></i>
                    @if (session()->get('lang') == 'ru')
                        Сбросить
                    @elseif(session()->get('lang') == 'en')
                        Reset
                    @else
                        Тоза кардан
                    @endif
                </button>
            </div>
        </div>

        {{-- Счетчик результатов --}}
        <div class="mt-3">
            <p class="text-muted mb-0" id="resultsCount">
                @if (session()->get('lang') == 'ru')
                    Показано: <strong>{{ $allProjects->count() }}</strong> из <strong>{{ $allProjects->total() }}</strong> проектов
                @elseif(session()->get('lang') == 'en')
                    Showing: <strong>{{ $allProjects->count() }}</strong> of <strong>{{ $allProjects->total() }}</strong> projects
                @else
                    Намоиш дода шудааст: <strong>{{ $allProjects->count() }}</strong> аз <strong>{{ $allProjects->total() }}</strong> лоиҳа
                @endif
            </p>
        </div>
    </div>

    {{-- Индикатор загрузки --}}
    <div id="loadingSpinner" class="text-center py-5" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2 text-muted">
            @if (session()->get('lang') == 'ru')
                Загрузка проектов...
            @elseif(session()->get('lang') == 'en')
                Loading projects...
            @else
                Боркунии лоиҳаҳо...
            @endif
        </p>
    </div>

    {{-- Сетка проектов --}}
    <div class="row g-4" id="projectsGrid">
        @foreach($allProjects as $project)
        <div class="col-lg-4 col-md-6 col-12 project-card" 
             data-title-ru="{{ strtolower($project->title_ru ?? '') }}"
             data-title-en="{{ strtolower($project->title_en ?? '') }}"
             data-title-tj="{{ strtolower($project->title_tj ?? '') }}"
             data-text-ru="{{ strtolower(strip_tags($project->text_ru ?? '')) }}"
             data-text-en="{{ strtolower(strip_tags($project->text_en ?? '')) }}"
             data-text-tj="{{ strtolower(strip_tags($project->text_tj ?? '')) }}"
             data-start-date="{{ $project->start_date }}"
             data-end-date="{{ $project->end_date }}"
             data-status="{{ $project->end_date ? (\Carbon\Carbon::now()->lessThanOrEqualTo($project->end_date) ? 'active' : 'completed') : 'active' }}">
            <div class="card h-100 shadow-sm border-0 rounded-3 project-item">
                {{-- Бейдж статуса --}}
                @php
                    $isActive = $project->end_date ? \Carbon\Carbon::now()->lessThanOrEqualTo($project->end_date) : true;
                @endphp
                <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                    @if($isActive)
                        <span class="badge bg-success">
                            @if (session()->get('lang') == 'ru')
                                Активный
                            @elseif(session()->get('lang') == 'en')
                                Active
                            @else
                                Фаъол
                            @endif
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            @if (session()->get('lang') == 'ru')
                                Завершен
                            @elseif(session()->get('lang') == 'en')
                                Completed
                            @else
                                Анҷомёфта
                            @endif
                        </span>
                    @endif
                </div>

                {{-- Фото --}}
                @if($project->image)
                    <img src="{{ $project->image }}"
                         class="card-img-top"
                         style="height: 220px; object-fit: cover;"
                         alt="{{ $project->title_ru }}">
                @endif
                <div class="card-body d-flex flex-column">
                    {{-- Заголовок --}}
                    <h5 class="card-title fw-bold">
                        @if (session()->get('lang') == 'ru')
                            {{ $project->title_ru }}
                        @elseif(session()->get('lang') == 'en')
                            {{ $project->title_en }}
                        @else
                            {{ $project->title_tj }}
                        @endif
                    </h5>

                    {{-- Даты проекта --}}
                    @if($project->start_date || $project->end_date)
                        <div class="mb-3">
                            <small class="text-muted d-block">
                                <i class="bi bi-calendar-event me-1"></i>
                                @if($project->start_date)
                                    {{ \Carbon\Carbon::parse($project->start_date)->format('d.m.Y') }}
                                @endif
                                @if($project->end_date)
                                    - {{ \Carbon\Carbon::parse($project->end_date)->format('d.m.Y') }}
                                @endif
                            </small>
                        </div>
                    @endif

                    {{-- Короткое описание --}}
                    <p class="card-text text-muted small flex-grow-1">
                        @if (session()->get('lang') == 'ru')
                            {{ \Illuminate\Support\Str::limit(strip_tags($project->text_ru), 150) }}
                        @elseif(session()->get('lang') == 'en')
                            {{ \Illuminate\Support\Str::limit(strip_tags($project->text_en), 150) }}
                        @else
                            {{ \Illuminate\Support\Str::limit(strip_tags($project->text_tj), 150) }}
                        @endif
                    </p>
                    {{-- Кнопка --}}
                    <a href="{{ route('frontend.project.detail', $project->id) }}"
                       class="btn btn-primary mt-auto rounded-pill">
                        @if (session()->get('lang') == 'ru')
                            Подробнее
                        @elseif(session()->get('lang') == 'en')
                            Read More
                        @else
                            Муфассалтар
                        @endif
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Сообщение "Ничего не найдено" --}}
    <div id="noResults" class="text-center py-5" style="display: none;">
        <i class="bi bi-folder-x" style="font-size: 4rem; color: #ccc;"></i>
        <h4 class="mt-3 text-muted">
            @if (session()->get('lang') == 'ru')
                Проекты не найдены
            @elseif(session()->get('lang') == 'en')
                No projects found
            @else
                Лоиҳаҳо ёфт нашуданд
            @endif
        </h4>
        <p class="text-muted">
            @if (session()->get('lang') == 'ru')
                Попробуйте изменить параметры поиска или фильтрации
            @elseif(session()->get('lang') == 'en')
                Try changing your search or filter parameters
            @else
                Параметрҳои ҷустуҷӯ ё филтрро тағйир диҳед
            @endif
        </p>
    </div>

    {{-- Пагинация --}}
    <div class="mt-5 d-flex justify-content-center" id="paginationContainer">
        {{ $allProjects->links() }}
    </div>
</div>

<style>
    .filter-panel {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .project-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .project-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }

    .project-card {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .project-card.hiding {
        opacity: 0;
        transform: scale(0.9);
    }

    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }

    .input-group-text {
        border: 1px solid #ced4da;
    }

    #loadingSpinner {
        animation: fadeIn 0.3s ease;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @media (max-width: 768px) {
        .filter-panel {
            padding: 20px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const resetButton = document.getElementById('resetFilters');
    const projectCards = document.querySelectorAll('.project-card');
    const resultsCount = document.getElementById('resultsCount');
    const noResults = document.getElementById('noResults');
    const projectsGrid = document.getElementById('projectsGrid');
    const paginationContainer = document.getElementById('paginationContainer');

    // Функция фильтрации
    function filterProjects() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const statusValue = statusFilter.value;
        let visibleCount = 0;

        projectCards.forEach(card => {
            // Получаем все поля для поиска на всех языках
            const titleRu = card.getAttribute('data-title-ru') || '';
            const titleEn = card.getAttribute('data-title-en') || '';
            const titleTj = card.getAttribute('data-title-tj') || '';
            const textRu = card.getAttribute('data-text-ru') || '';
            const textEn = card.getAttribute('data-text-en') || '';
            const textTj = card.getAttribute('data-text-tj') || '';
            const status = card.getAttribute('data-status');

            // Проверка поиска по всем языкам (RU, EN, TJ)
            const matchesSearch = !searchTerm || 
                                  titleRu.includes(searchTerm) || 
                                  titleEn.includes(searchTerm) || 
                                  titleTj.includes(searchTerm) ||
                                  textRu.includes(searchTerm) ||
                                  textEn.includes(searchTerm) ||
                                  textTj.includes(searchTerm);

            // Проверка статуса
            const matchesStatus = statusValue === 'all' || status === statusValue;

            // Показать/скрыть карточку с плавной анимацией
            if (matchesSearch && matchesStatus) {
                card.classList.remove('hiding');
                card.style.display = 'block';
                // Небольшая задержка для плавного появления
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 10);
                visibleCount++;
            } else {
                card.classList.add('hiding');
                setTimeout(() => {
                    if (card.classList.contains('hiding')) {
                        card.style.display = 'none';
                    }
                }, 300);
            }
        });

        // Обновить счетчик результатов
        updateResultsCount(visibleCount);

        // Показать/скрыть сообщение "Ничего не найдено"
        if (visibleCount === 0) {
            noResults.style.display = 'block';
            paginationContainer.style.display = 'none';
        } else {
            noResults.style.display = 'none';
            paginationContainer.style.display = 'flex';
        }
    }

    // Обновление счетчика результатов
    function updateResultsCount(count) {
        const lang = '{{ session()->get("lang") ?? "tj" }}';
        const total = projectCards.length;
        
        let text = '';
        if (lang === 'ru') {
            text = `Показано: <strong>${count}</strong> из <strong>${total}</strong> проектов`;
        } else if (lang === 'en') {
            text = `Showing: <strong>${count}</strong> of <strong>${total}</strong> projects`;
        } else {
            text = `Намоиш дода шудааст: <strong>${count}</strong> аз <strong>${total}</strong> лоиҳа`;
        }
        
        resultsCount.innerHTML = text;
    }

    // События поиска с небольшой задержкой (debounce) для производительности
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(filterProjects, 300);
    });

    // Событие изменения фильтра статуса
    statusFilter.addEventListener('change', filterProjects);

    // Сброс всех фильтров
    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = 'all';
        filterProjects();
        
        // Визуальная обратная связь
        resetButton.innerHTML = '<i class="bi bi-check me-1"></i>{{ session()->get("lang") == "ru" ? "Сброшено" : (session()->get("lang") == "en" ? "Reset" : "Тоза карда шуд") }}';
        setTimeout(() => {
            resetButton.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i>{{ session()->get("lang") == "ru" ? "Сбросить" : (session()->get("lang") == "en" ? "Reset" : "Тоза кардан") }}';
        }, 2000);
    });

    // Инициализация при загрузке страницы
    filterProjects();

    // Подсветка текста при поиске (опционально)
    searchInput.addEventListener('focus', function() {
        this.select();
    });
});
</script>

@endsection
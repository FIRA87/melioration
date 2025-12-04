@extends('frontend.master')

@section('title')
    @if(session('lang') == 'ru')
        Документы
    @elseif(session('lang') == 'en')    
        Documents
    @else 
        Ҳуҷҷатҳо
    @endif
@endsection

@section('content')


<!-- Banner Start -->
<section class="custom-banner">
    <div class="container">
        <div class="custom-banner-left">          
            <h1 class="custom-banner-title text-left">
                @if(session('lang') == 'ru')
            Документы
        @elseif(session('lang') == 'en')
            Documents
        @else 
            Ҳуҷҷатҳо
        @endif
            </h1>
        </div>
    </div>
</section>
<!-- Banner End -->


<div class="container py-5">

    <!-- Фильтры -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body filter-panel">
            <div class="row g-3 align-items-end">

                <!-- Поиск -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        @if(session('lang') == 'ru') Поиск по документам
                        @elseif(session('lang') == 'en') Search documents
                        @else Ҷустуҷӯ дар ҳуҷҷатҳо
                        @endif
                    </label>
                    <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="@if(session('lang') == 'ru')Введите название документа...@elseif(session('lang') == 'en')Enter document title...@else Навиштани номи ҳуҷҷат...@endif">
                </div>

                <!-- Фильтр по типу файла -->
                <div class="col-md-3">
                    <label class="form-label fw-bold">
                        @if(session('lang') == 'ru') Тип файла
                        @elseif(session('lang') == 'en') File type
                        @else Навъи файл
                        @endif
                    </label>
                    <select id="typeFilter" class="form-select form-select-lg">
                        <option value="all">
                            @if(session('lang') == 'ru') Все
                            @elseif(session('lang') == 'en') All
                            @else Ҳама
                            @endif
                        </option>
                        <option value="pdf">PDF</option>
                        <option value="doc">DOC/DOCX</option>
                        <option value="xls">XLS/XLSX</option>
                        <option value="ppt">PPT/PPTX</option>
                        <option value="zip">ZIP</option>
                    </select>
                </div>

                <!-- Сортировка -->
                <div class="col-md-3">
                    <label class="form-label fw-bold">
                        @if(session('lang') == 'ru') Сортировка
                        @elseif(session('lang') == 'en') Sort
                        @else Ҷобаҷо
                        @endif
                    </label>
                    <select id="sortFilter" class="form-select form-select-lg">
                        <option value="desc" selected>
                            @if(session('lang') == 'ru') Новые → Старые
                            @elseif(session('lang') == 'en') New → Old
                            @else Нав → Куҳна
                            @endif
                        </option>
                        <option value="asc">
                            @if(session('lang') == 'ru') Старые → Новые
                            @elseif(session('lang') == 'en') Old → New
                            @else Куҳна → Нав
                            @endif
                        </option>
                    </select>
                </div>

                <!-- Сброс -->
                <div class="col-md-2 d-grid">
                    <button type="button" class="btn btn-outline-secondary btn-lg" id="resetFilters">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                        @if(session('lang') == 'ru') Сбросить
                        @elseif(session('lang') == 'en') Reset
                        @else Тоза кардан
                        @endif
                    </button>
                </div>

            </div>

            <!-- Счетчик -->
            <div class="mt-3">
                <p class="text-muted mb-0" id="resultsCount">
                    @if(session('lang') == 'ru') Показано: <strong>{{ $documents->count() }}</strong> из <strong>{{ $documents->total() }}</strong> документов
                    @elseif(session('lang') == 'en') Showing: <strong>{{ $documents->count() }}</strong> of <strong>{{ $documents->total() }}</strong> documents
                    @else Намоиш дода шудааст: <strong>{{ $documents->count() }}</strong> аз <strong>{{ $documents->total() }}</strong> ҳуҷҷат
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Список документов -->
    <div class="row g-4" id="documentsGrid">
        @foreach($documents as $doc)
        @php
            $icons = [
                'pdf' => 'bi-file-earmark-pdf text-danger',
                'doc' => 'bi-file-earmark-word text-primary',
                'docx'=> 'bi-file-earmark-word text-primary',
                'xls' => 'bi-file-earmark-excel text-success',
                'xlsx'=> 'bi-file-earmark-excel text-success',
                'ppt' => 'bi-file-earmark-ppt text-warning',
                'pptx'=> 'bi-file-earmark-ppt text-warning',
                'zip' => 'bi-file-earmark-zip text-secondary',
            ];
            $ext = strtolower($doc->file_type);
            $icon = $icons[$ext] ?? 'bi-file-earmark';
        @endphp

        <div class="col-lg-3 col-md-4 col-12 document-card"
             data-title-ru="{{ strtolower($doc->title_ru ?? '') }}"
             data-title-en="{{ strtolower($doc->title_en ?? '') }}"
             data-title-tj="{{ strtolower($doc->title_tj ?? '') }}"
             data-desc-ru="{{ strtolower(strip_tags($doc->description_ru ?? '')) }}"
             data-desc-en="{{ strtolower(strip_tags($doc->description_en ?? '')) }}"
             data-desc-tj="{{ strtolower(strip_tags($doc->description_tj ?? '')) }}"
             data-type="{{ $ext }}"
             data-date="{{ $doc->published_at }}">
            <div class="card shadow-sm border-0 h-100 rounded-4">
                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <i class="bi {{ $icon }}" style="font-size: 2rem;"></i>
                    </div>
                    <h6 class="fw-bold mb-2">
                        @if(session('lang') == 'ru') {{ $doc->title_ru }}
                        @elseif(session('lang') == 'en') {{ $doc->title_en }}
                        @else {{ $doc->title_tj }}
                        @endif
                    </h6>
                    <span class="text-muted small mb-3">
                        {{ \Carbon\Carbon::parse($doc->published_at)->format('d.m.Y') }}
                    </span>
                    <p class="flex-grow-1 text-muted">
                        @if(session('lang') == 'ru') {{ Str::limit($doc->description_ru, 120) }}
                        @elseif(session('lang') == 'en') {{ Str::limit($doc->description_en, 120) }}
                        @else {{ Str::limit($doc->description_tj, 120) }}
                        @endif
                    </p>
                    <span class="badge bg-secondary mb-3">
                        {{ strtoupper($doc->file_type) }}
                    </span>
                    <a href="{{ route('frontend.documents.download', $doc->id) }}" class="btn btn-outline-success mt-auto">
                        <i class="bi bi-download me-1"></i>
                        Скачать
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Сообщение "Ничего не найдено" -->
    <div id="noResults" class="text-center py-5" style="display: none;">
        <i class="bi bi-folder-x" style="font-size: 4rem; color: #ccc;"></i>
        <h4 class="mt-3 text-muted">
            @if(session('lang') == 'ru') Документы не найдены
            @elseif(session('lang') == 'en') No documents found
            @else Ҳуҷҷатҳо ёфт нашуданд
            @endif
        </h4>
        <p class="text-muted">
            @if(session('lang') == 'ru') Попробуйте изменить параметры поиска или фильтрации
            @elseif(session('lang') == 'en') Try changing your search or filter parameters
            @else Параметрҳои ҷустуҷӯ ё филтрро тағйир диҳед
            @endif
        </p>
    </div>

    <!-- Пагинация -->
    <div class="mt-4 d-flex justify-content-center" id="paginationContainer">
        {{ $documents->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const sortFilter = document.getElementById('sortFilter');
    const resetButton = document.getElementById('resetFilters');
    const documentCards = document.querySelectorAll('.document-card');
    const resultsCount = document.getElementById('resultsCount');
    const noResults = document.getElementById('noResults');
    const documentsGrid = document.getElementById('documentsGrid');
    const paginationContainer = document.getElementById('paginationContainer');

    function filterDocuments() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const typeValue = typeFilter.value;
        const sortValue = sortFilter.value;
        let visibleCards = [];

        documentCards.forEach(card => {
            const titleRu = card.getAttribute('data-title-ru') || '';
            const titleEn = card.getAttribute('data-title-en') || '';
            const titleTj = card.getAttribute('data-title-tj') || '';
            const descRu = card.getAttribute('data-desc-ru') || '';
            const descEn = card.getAttribute('data-desc-en') || '';
            const descTj = card.getAttribute('data-desc-tj') || '';
            const type = card.getAttribute('data-type');

            const matchesSearch = !searchTerm || 
                                  titleRu.includes(searchTerm) || 
                                  titleEn.includes(searchTerm) || 
                                  titleTj.includes(searchTerm) ||
                                  descRu.includes(searchTerm) ||
                                  descEn.includes(searchTerm) ||
                                  descTj.includes(searchTerm);

            const matchesType = typeValue === 'all' || type === typeValue;

            if (matchesSearch && matchesType) {
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

        // Сортировка по дате
        visibleCards.sort((a, b) => {
            const dateA = new Date(a.getAttribute('data-date'));
            const dateB = new Date(b.getAttribute('data-date'));
            return sortValue === 'asc' ? dateA - dateB : dateB - dateA;
        });

        visibleCards.forEach(card => documentsGrid.appendChild(card));

        updateResultsCount(visibleCards.length);

        noResults.style.display = visibleCards.length === 0 ? 'block' : 'none';
        paginationContainer.style.display = visibleCards.length === 0 ? 'none' : 'flex';
    }

    function updateResultsCount(count) {
        const lang = '{{ session()->get("lang") ?? "tj" }}';
        const total = documentCards.length;
        let text = '';
        if (lang === 'ru') {
            text = `Показано: <strong>${count}</strong> из <strong>${total}</strong> документов`;
        } else if (lang === 'en') {
            text = `Showing: <strong>${count}</strong> of <strong>${total}</strong> documents`;
        } else {
            text = `Намоиш дода шудааст: <strong>${count}</strong> аз <strong>${total}</strong> ҳуҷҷат`;
        }
        resultsCount.innerHTML = text;
    }

    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(filterDocuments, 300);
    });

    typeFilter.addEventListener('change', filterDocuments);
    sortFilter.addEventListener('change', filterDocuments);

    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        typeFilter.value = 'all';
        sortFilter.value = 'desc';
        filterDocuments();
        resetButton.innerHTML = '<i class="bi bi-check me-1"></i>{{ session()->get("lang") == "ru" ? "Сброшено" : (session()->get("lang") == "en" ? "Reset" : "Тоза карда шуд") }}';
        setTimeout(() => {
            resetButton.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i>{{ session()->get("lang") == "ru" ? "Сбросить" : (session()->get("lang") == "en" ? "Reset" : "Тоза кардан") }}';
        }, 2000);
    });

    filterDocuments();
});
</script>

<style>
.document-card {
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.document-card.hiding {
    opacity: 0;
    transform: scale(0.95);
}
.filter-panel {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
</style>

@endsection

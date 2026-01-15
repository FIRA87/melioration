<header class="bg-white shadow-sm sticky-top">
    <!-- Верхний блок с логотипами -->
 
    <div class="container py-3">
        <div class="header-top d-flex justify-content-between align-items-center flex-wrap">

            <!-- Логотип 2 -->
            <div class="d-flex align-items-center gap-2 header-item">
                <a href="{{ url('/') }}">
                    <img src="{{ '/'. $siteSettings->logo }}" class="header-logo" alt="logo2">
                </a>

                <div class="header-text">
                    <div class="">
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
    </div>

    <div class="border-top"></div>

    <!-- Навигация -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <!-- Мобильная версия: языки и поиск сверху -->
        <div class="d-flex d-lg-none w-100 justify-content-between align-items-center mb-2">
            <div class="d-flex align-items-center gap-2">
                <select class="form-select form-select-sm border-0" onchange="location.href=this.value" style="width:70px;">
                    <option value="{{ route('tj.lang') }}" @selected(session('lang')=='tj')>Тоҷ</option>
                    <option value="{{ route('ru.lang') }}" @selected(session('lang')=='ru')>Рус</option>
                    <option value="{{ route('en.lang') }}" @selected(session('lang')=='en')>Eng</option>
                </select>
                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Меню и десктопные блоки -->
        <div class="collapse navbar-collapse d-lg-flex justify-content-between align-items-center" id="navbarNav">
            
            <!-- Меню слева -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('/') }}">
                        @if(session('lang') == 'ru') Главная
                        @elseif(session('lang') == 'en') Home
                        @else Асосӣ @endif
                    </a>
                </li>
                @foreach($pages as $p)
                    @php
                        $hasSubmenu = isset($subPages[$p->id]) && $subPages[$p->id]->count() > 0;
                    @endphp
                    <li class="nav-item {{ $hasSubmenu ? 'dropdown' : '' }}">
                        <a class="nav-link fw-semibold {{ $hasSubmenu ? 'dropdown-toggle' : '' }}" href="{{ route('menu.show', $p->id) }}" @if($hasSubmenu) id="dropdown{{ $p->id }}" role="button" aria-expanded="false" @endif>
                            @if(session('lang') == 'ru') {{ $p->title_ru }} 
                            @elseif(session('lang') == 'en') {{ $p->title_en }} 
                            @else {{ $p->title_tj }} @endif
                        </a>
                        @if($hasSubmenu)
                            <ul class="dropdown-menu border-0 shadow-sm">
                                @foreach($subPages[$p->id] as $child)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('submenu.show', $child) }}">
                                            @if(session('lang') == 'ru') {{ $child->title_ru }}
                                            @elseif(session('lang') == 'en') {{ $child->title_en }}
                                            @else {{ $child->title_tj }} @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

            <!-- Языки + поиск справа (десктоп) -->
            <div class="d-none d-lg-flex align-items-center gap-2 ms-3">
                <select class="form-select form-select-sm" onchange="location.href=this.value" style="width:80px; border: 0;">
                    <option value="{{ route('tj.lang') }}" @selected(session('lang')=='tj')>Тоҷ</option>
                    <option value="{{ route('ru.lang') }}" @selected(session('lang')=='ru')>Рус</option>
                    <option value="{{ route('en.lang') }}" @selected(session('lang')=='en')>Eng</option>
                </select>
                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="bi bi-search"></i>
                </button>
            </div>

        </div>
    </div>
</nav>

</header>

<!-- Поиск (модальное окно) -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    {{ session('lang')=='ru' ? 'Поиск' : (session('lang')=='en' ? 'Search' : 'Ҷустуҷӯ') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('news.search') }}">
                    @csrf
                    <div class="input-group input-group-lg">
                        <input type="text" 
                               class="form-control border-2" 
                               placeholder="{{ session('lang')=='ru'?'Введите запрос...':(session('lang')=='en'?'Enter query...':'Дархостро ворид кунед...') }}" 
                               name="search" 
                               required
                               autofocus>
                        <button class="btn btn-success px-4" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Логотипы */
    .header-logo {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border-radius: 8px;
    }

    /* Заголовки */
    .header-title {
        font-size: 0.95rem;
    }

    /* Sticky header */
    .sticky-top {
        top: 0;
        z-index: 1020;
    }

    /* Навигация */
    .nav-link {
        color: #333;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: #0d6efd;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    /* Dropdown меню */
    .dropdown-menu {
        margin-top: 0.5rem;
        border-radius: 12px;
        animation: fadeIn 0.2s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        padding: 0.6rem 1.2rem;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
        padding-left: 1.5rem;
    }

    /* Hover меню на десктопе */
    @media (min-width: 992px) {
        .nav-item.dropdown:hover > .dropdown-menu {
            display: block;
        }
        
        /* Делаем главную ссылку кликабельной на десктопе */
        .nav-item.dropdown .nav-link {
            pointer-events: auto;
        }
    }

    /* Мобильное меню */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: white;
            padding: 1rem 0;
            margin-top: 1rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .dropdown-menu {
            border: none;
            box-shadow: none;
            padding-left: 1rem;
        }

        .nav-link {
            border-radius: 8px;
            margin: 0.2rem 0.5rem;
        }

        /* Открытие подменю при наведении на мобильных */
        .nav-item.dropdown:hover > .dropdown-menu {
            display: block;
        }
    }

    /* Адаптивность логотипов */
    @media (max-width: 576px) {
        .header-logo {
            width: 50px;
            height: 50px;
        }

        .header-title {
            font-size: 0.85rem;
        }
    }

    /* Кнопка поиска */
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    /* Форма выбора языка */
    .form-select-sm {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        cursor: pointer;
    }

    .form-select-sm:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        // Закрытие мобильного меню при клике на ссылку
        navLinks.forEach(link => {
            // Только для ссылок без dropdown
            if (!link.classList.contains('dropdown-toggle')) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                        bsCollapse.hide();
                    }
                });
            }
        });

        // Для десктопа: делаем главную ссылку dropdown кликабельной
        const dropdownLinks = document.querySelectorAll('.nav-item.dropdown > .nav-link');
        
        dropdownLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // На десктопе разрешаем переход по ссылке
                if (window.innerWidth >= 992) {
                    // Не предотвращаем default, чтобы ссылка работала
                    return true;
                }
            });
        });
    });
</script>
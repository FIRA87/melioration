@extends('admin.admin_dashboard')
@section('admin')


<style>
    .sort-icon {
        cursor: pointer;
        user-select: none;
        opacity: 0.3;
        transition: opacity 0.2s;
    }
    .sort-icon:hover {
        opacity: 0.6;
    }
    .sort-icon.active {
        opacity: 1;
    }
    th {
        white-space: nowrap;
    }
    .search-highlight {
        background-color: #fff3cd;
        font-weight: bold;
    }
</style>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Статические переводы</h4>
        @if(Auth::user()->can('static_translations_add'))
            <a href="{{ route('static-translations.create') }}" class="btn btn-primary">Добавить</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-body">
        <!-- Поиск и фильтры -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Поиск по всем полям:</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Введите текст для поиска...">
            </div>
            <div class="col-md-3">
                <label>Фильтр по группе:</label>
                <select class="form-control" id="groupFilter">
                    <option value="">Все группы</option>
                    @foreach($groups as $group)
                        <option value="{{ $group }}">{{ $group }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Показать строк:</label>
                <select class="form-control" id="rowsPerPage">
                    <option value="10" selected>10</option>
                    <option value="20" >20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="all">Все</option>
                </select>
            </div>
        </div>

        <div class="mb-2">
            <small class="text-muted">Найдено записей: <strong id="recordCount">{{ $translations->count() }}</strong></small>
        </div>

        <div class="table-responsive">
            <table class="table table-striped" id="translationsTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">
                            ID <span class="sort-icon" data-col="0">↕</span>
                        </th>
                        <th onclick="sortTable(1)">
                            Ключ <span class="sort-icon" data-col="1">↕</span>
                        </th>
                        <th onclick="sortTable(2)">
                            Группа <span class="sort-icon" data-col="2">↕</span>
                        </th>
                        <th onclick="sortTable(3)">
                            RU <span class="sort-icon" data-col="3">↕</span>
                        </th>
                        <th onclick="sortTable(4)">
                            EN <span class="sort-icon" data-col="4">↕</span>
                        </th>
                        <th onclick="sortTable(5)">
                            TJ <span class="sort-icon" data-col="5">↕</span>
                        </th>
                        <th onclick="sortTable(6)">
                            Описание <span class="sort-icon" data-col="6">↕</span>
                        </th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach($translations as $translation)
                        <tr data-group="{{ $translation->group }}" 
                            data-id="{{ $translation->id }}"
                            data-key="{{ $translation->key }}"
                            data-group-text="{{ $translation->group ?? 'Без группы' }}"
                            data-ru="{{ $translation->value_ru }}"
                            data-en="{{ $translation->value_en }}"
                            data-tj="{{ $translation->value_tj }}"
                            data-desc="{{ $translation->description }}">
                            <td>{{ $translation->id }}</td>
                            <td><code>{{ $translation->key }}</code></td>
                            <td><span class="badge bg-info">{{ $translation->group ?? 'Без группы' }}</span></td>
                            <td>{{ Str::limit($translation->value_ru, 30) }}</td>
                            <td>{{ Str::limit($translation->value_en, 30) }}</td>
                            <td>{{ Str::limit($translation->value_tj, 30) }}</td>
                            <td>{{ Str::limit($translation->description, 30) }}</td>
                            <td>

                                @if(Auth::user()->can('static_translations_edit'))
                                    <a href="{{ route('static-translations.edit', $translation->id) }}" class="btn btn-sm btn-info">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                @endif
                                

                                @if(Auth::user()->can('static_translations_delete'))                                
                                    <form action="{{ route('static-translations.destroy', $translation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')"><i class="mdi mdi-delete"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        <div id="pagination" class="d-flex justify-content-center mt-3">
            <nav>
                <ul class="pagination" id="paginationList"></ul>
            </nav>
        </div>
    </div>
</div>

<script>
    let allRows = [];
    let filteredRows = [];
    let currentPage = 1;
    let rowsPerPage = 10;
    let currentSortColumn = -1;
    let sortAscending = true;

    // Инициализация
    document.addEventListener('DOMContentLoaded', function() {
        // Сохраняем все строки
        allRows = Array.from(document.querySelectorAll('#tableBody tr'));
        filteredRows = [...allRows];
        
        // События
        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('groupFilter').addEventListener('change', applyFilters);
        document.getElementById('rowsPerPage').addEventListener('change', function() {
            rowsPerPage = this.value === 'all' ? filteredRows.length : parseInt(this.value);
            currentPage = 1;
            renderTable();
        });
        
        renderTable();
    });

    // Применение фильтров (поиск + группа)
    function applyFilters() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const selectedGroup = document.getElementById('groupFilter').value;
        
        filteredRows = allRows.filter(row => {
            // Фильтр по группе
            const groupMatch = !selectedGroup || row.dataset.group === selectedGroup;
            
            // Поиск по всем полям
            let searchMatch = true;
            if (searchTerm) {
                const searchableText = [
                    row.dataset.id,
                    row.dataset.key,
                    row.dataset.groupText,
                    row.dataset.ru,
                    row.dataset.en,
                    row.dataset.tj,
                    row.dataset.desc
                ].join(' ').toLowerCase();
                
                searchMatch = searchableText.includes(searchTerm);
            }
            
            return groupMatch && searchMatch;
        });
        
        // Обновляем счетчик
        document.getElementById('recordCount').textContent = filteredRows.length;
        
        currentPage = 1;
        renderTable();
    }

    // Сортировка таблицы
    function sortTable(columnIndex) {
        // Определяем направление сортировки
        if (currentSortColumn === columnIndex) {
            sortAscending = !sortAscending;
        } else {
            sortAscending = true;
            currentSortColumn = columnIndex;
        }
        
        // Обновляем иконки сортировки
        document.querySelectorAll('.sort-icon').forEach(icon => {
            icon.classList.remove('active');
            icon.textContent = '↕';
        });
        
        const activeIcon = document.querySelector(`[data-col="${columnIndex}"]`);
        activeIcon.classList.add('active');
        activeIcon.textContent = sortAscending ? '↑' : '↓';
        
        // Сортируем
        filteredRows.sort((a, b) => {
            let aVal, bVal;
            
            switch(columnIndex) {
                case 0: // ID
                    aVal = parseInt(a.dataset.id);
                    bVal = parseInt(b.dataset.id);
                    break;
                case 1: // Ключ
                    aVal = a.dataset.key.toLowerCase();
                    bVal = b.dataset.key.toLowerCase();
                    break;
                case 2: // Группа
                    aVal = a.dataset.groupText.toLowerCase();
                    bVal = b.dataset.groupText.toLowerCase();
                    break;
                case 3: // RU
                    aVal = a.dataset.ru.toLowerCase();
                    bVal = b.dataset.ru.toLowerCase();
                    break;
                case 4: // EN
                    aVal = a.dataset.en.toLowerCase();
                    bVal = b.dataset.en.toLowerCase();
                    break;
                case 5: // TJ
                    aVal = a.dataset.tj.toLowerCase();
                    bVal = b.dataset.tj.toLowerCase();
                    break;
                case 6: // Описание
                    aVal = a.dataset.desc.toLowerCase();
                    bVal = b.dataset.desc.toLowerCase();
                    break;
                default:
                    return 0;
            }
            
            if (aVal < bVal) return sortAscending ? -1 : 1;
            if (aVal > bVal) return sortAscending ? 1 : -1;
            return 0;
        });
        
        renderTable();
    }

    // Отрисовка таблицы с пагинацией
    function renderTable() {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';
        
        // Вычисляем диапазон строк для текущей страницы
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = rowsPerPage === filteredRows.length ? filteredRows.length : startIndex + rowsPerPage;
        const pageRows = filteredRows.slice(startIndex, endIndex);
        
        // Добавляем строки
        pageRows.forEach(row => {
            tbody.appendChild(row.cloneNode(true));
        });
        
        // Отображаем сообщение если ничего не найдено
        if (filteredRows.length === 0) {
            tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4">Ничего не найдено</td></tr>';
        }
        
        // Рендерим пагинацию
        renderPagination();
    }

    // Отрисовка пагинации
    function renderPagination() {
        const paginationList = document.getElementById('paginationList');
        paginationList.innerHTML = '';
        
        if (rowsPerPage >= filteredRows.length) {
            document.getElementById('pagination').style.display = 'none';
            return;
        }
        
        document.getElementById('pagination').style.display = 'flex';
        
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        
        // Кнопка "Предыдущая"
        const prevLi = document.createElement('li');
        prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">«</a>`;
        paginationList.appendChild(prevLi);
        
        // Номера страниц
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);
        
        if (startPage > 1) {
            const li = document.createElement('li');
            li.className = 'page-item';
            li.innerHTML = `<a class="page-link" href="#" onclick="changePage(1); return false;">1</a>`;
            paginationList.appendChild(li);
            
            if (startPage > 2) {
                const dots = document.createElement('li');
                dots.className = 'page-item disabled';
                dots.innerHTML = `<span class="page-link">...</span>`;
                paginationList.appendChild(dots);
            }
        }
        
        for (let i = startPage; i <= endPage; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>`;
            paginationList.appendChild(li);
        }
        
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const dots = document.createElement('li');
                dots.className = 'page-item disabled';
                dots.innerHTML = `<span class="page-link">...</span>`;
                paginationList.appendChild(dots);
            }
            
            const li = document.createElement('li');
            li.className = 'page-item';
            li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${totalPages}); return false;">${totalPages}</a>`;
            paginationList.appendChild(li);
        }
        
        // Кнопка "Следующая"
        const nextLi = document.createElement('li');
        nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">»</a>`;
        paginationList.appendChild(nextLi);
    }

    // Смена страницы
    function changePage(page) {
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        if (page < 1 || page > totalPages) return;
        
        currentPage = page;
        renderTable();
        
        // Прокрутка наверх таблицы
        document.getElementById('translationsTable').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>





@endsection
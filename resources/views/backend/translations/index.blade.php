@extends('admin.admin_dashboard')
@section('admin')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Статические переводы</h4>
        <a href="{{ route('static-translations.create') }}" class="btn btn-primary">Добавить перевод</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-body">
        <!-- Фильтр по группам -->
        <div class="mb-3">
            <label>Фильтр по группе:</label>
            <select class="form-control" id="groupFilter" onchange="filterByGroup()">
                <option value="">Все группы</option>
                @foreach($groups as $group)
                    <option value="{{ $group }}">{{ $group }}</option>
                @endforeach
            </select>
        </div>

        <div class="table-responsive">
            <table class="table table-striped" id="basic-datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ключ</th>
                        <th>Группа</th>
                        <th>RU</th>
                        <th>EN</th>
                        <th>TJ</th>
                        <th>Описание</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($translations as $translation)
                        <tr data-group="{{ $translation->group }}">
                            <td>{{ $translation->id }}</td>
                            <td><code>{{ $translation->key }}</code></td>
                            <td><span class="badge bg-info">{{ $translation->group ?? 'Без группы' }}</span></td>
                            <td>{{ Str::limit($translation->value_ru, 30) }}</td>
                            <td>{{ Str::limit($translation->value_en, 30) }}</td>
                            <td>{{ Str::limit($translation->value_tj, 30) }}</td>
                            <td>{{ Str::limit($translation->description, 30) }}</td>
                            <td>
                                <a href="{{ route('static-translations.edit', $translation->id) }}" class="btn btn-sm btn-info">Изменить</a>
                                <form action="{{ route('static-translations.destroy', $translation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $translations->links() }}
    </div>
</div>

<script>
function filterByGroup() {
    const selected = document.getElementById('groupFilter').value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        if (selected === '' || row.dataset.group === selected) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>

@endsection
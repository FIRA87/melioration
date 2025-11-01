@extends('admin.admin_dashboard')
@section('admin')

{{-- Alpine (опционально) и jQuery не нужны — всё на pure JS/fetch --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="m-0">Опросы</h3>
        <div>
            <button class="btn btn-success" id="btnOpenCreate">Создать опрос</button>
        </div>
    </div>

    <div id="alerts"></div>

    <div class="table-responsive">
        <table class="table table-bordered" id="surveysTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title RU</th>
                    <th>Title TJ</th>
                    <th>Title EN</th>
                    <th>Description RU</th>
                    <th>Active</th>
                    <th>Questions</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($surveys as $s)
                <tr data-id="{{ $s->id }}">
                    <td>{{ $s->id }}</td>
                    <td class="col-title-ru">{{ $s->title_ru }}</td>
                    <td class="col-title-tj">{{ $s->title_tj }}</td>
                    <td class="col-title-en">{{ $s->title_en }}</td>
                    <td class="col-desc-ru">{{ Str::limit($s->description_ru, 80) }}</td>
                    <td class="col-active">{!! $s->is_active ? '<span class="badge bg-success">Да</span>' : '<span class="badge bg-secondary">Нет</span>' !!}</td>
                    <td>{{ $s->questions_count ?? $s->questions()->count() }}</td>
                    <td>{{ $s->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $s->updated_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary btn-edit" data-id="{{ $s->id }}">Редактировать</button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $s->id }}">Удалить</button>
                        <a href="{{ route('admin.surveys.show', $s) }}" class="btn btn-sm btn-outline-secondary">Просмотр</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Create / Edit Modal (shared) --}}
<div class="modal" id="surveyModal" tabindex="-1" style="display:none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="surveyModalTitle">Создать опрос</h5>
        <button type="button" class="btn-close" id="modalCloseBtn"></button>
      </div>
      <div class="modal-body">
        <div id="modalErrors" class="mb-2"></div>

        <form id="surveyForm">
            <input type="hidden" id="surveyId" name="surveyId" value="">
            <div class="mb-3">
                <label class="form-label">Title (RU)</label>
                <input type="text" class="form-control" id="title_ru" name="title_ru" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Title (TJ)</label>
                <input type="text" class="form-control" id="title_tj" name="title_tj" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Title (EN)</label>
                <input type="text" class="form-control" id="title_en" name="title_en" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description (RU)</label>
                <textarea class="form-control" id="description_ru" name="description_ru" rows="3"></textarea>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                <label class="form-check-label" for="is_active">Активен</label>
            </div>

            <div class="text-end">
                <button class="btn btn-secondary" type="button" id="modalCancel">Отмена</button>
                <button class="btn btn-primary" type="submit" id="modalSave">Сохранить</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>

<style>
/* простой show/hide модального окна (если у тебя нет bootstrap js) */
.modal { position: fixed; inset:0; display:flex; align-items:center; justify-content:center; z-index:2000; background: rgba(0,0,0,.4); }
.modal .modal-dialog { max-width:900px; }
.hidden { display:none !important; }
</style>

<script>
const token = document.querySelector('meta[name="csrf-token"]').content;

function showModal(mode='create'){
    document.getElementById('surveyModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    document.getElementById('modalErrors').innerHTML = '';
    if(mode === 'create'){
        document.getElementById('surveyModalTitle').textContent = 'Создать опрос';
        document.getElementById('surveyForm').reset();
        document.getElementById('surveyId').value = '';
    } else {
        document.getElementById('surveyModalTitle').textContent = 'Редактировать опрос';
    }
}

function hideModal(){
    document.getElementById('surveyModal').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('btnOpenCreate').addEventListener('click', function(){
    showModal('create');
});

document.getElementById('modalCloseBtn').addEventListener('click', hideModal);
document.getElementById('modalCancel').addEventListener('click', hideModal);

// submit create/update
document.getElementById('surveyForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const id = document.getElementById('surveyId').value;
    const payload = {
        title_ru: document.getElementById('title_ru').value.trim(),
        title_tj: document.getElementById('title_tj').value.trim(),
        title_en: document.getElementById('title_en').value.trim(),
        description_ru: document.getElementById('description_ru').value.trim(),
        is_active: document.getElementById('is_active').checked ? 1 : 0
    };

    const url = id ? `/admin/surveys/${id}` : `/admin/surveys`;
    const method = id ? 'PUT' : 'POST';

    try {
        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const data = await res.json();

        if(!res.ok){
            // показать ошибки
            if(data.errors){
                let html = '<div class="alert alert-danger"><ul>';
                Object.values(data.errors).flat().forEach(err => { html += `<li>${err}</li>`; });
                html += '</ul></div>';
                document.getElementById('modalErrors').innerHTML = html;
            } else {
                document.getElementById('modalErrors').innerHTML = `<div class="alert alert-danger">${data.message || 'Ошибка'}</div>`;
            }
            return;
        }

        // success: если POST — добавить строку, если PUT — обновить строку
        if(method === 'POST'){
            const s = data.survey;
            const tbody = document.querySelector('#surveysTable tbody');
            const tr = document.createElement('tr');
            tr.setAttribute('data-id', s.id);
            tr.innerHTML = `
                <td>${s.id}</td>
                <td class="col-title-ru">${escapeHtml(s.title_ru)}</td>
                <td class="col-title-tj">${escapeHtml(s.title_tj)}</td>
                <td class="col-title-en">${escapeHtml(s.title_en)}</td>
                <td class="col-desc-ru">${escapeHtml((s.description_ru || '').slice(0,80))}</td>
                <td class="col-active">${s.is_active ? '<span class="badge bg-success">Да</span>' : '<span class="badge bg-secondary">Нет</span>'}</td>
                <td>0</td>
                <td>${new Date(s.created_at).toLocaleString()}</td>
                <td>${new Date(s.updated_at).toLocaleString()}</td>
                <td>
                    <button class="btn btn-sm btn-primary btn-edit" data-id="${s.id}">Редактировать</button>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="${s.id}">Удалить</button>
                    <a href="/admin/surveys/${s.id}" class="btn btn-sm btn-outline-secondary">Просмотр</a>
                </td>
            `;
            tbody.prepend(tr);
            attachRowListeners(tr); // навесим слушатели для новой строки
            showAlert('Опрос создан', 'success');
        } else {
            const s = data.survey;
            const row = document.querySelector(`#surveysTable tr[data-id="${s.id}"]`);
            if(row){
                row.querySelector('.col-title-ru').textContent = s.title_ru;
                row.querySelector('.col-title-tj').textContent = s.title_tj;
                row.querySelector('.col-title-en').textContent = s.title_en;
                row.querySelector('.col-desc-ru').textContent = (s.description_ru || '').slice(0,80);
                row.querySelector('.col-active').innerHTML = s.is_active ? '<span class="badge bg-success">Да</span>' : '<span class="badge bg-secondary">Нет</span>';
                row.querySelector('td:nth-child(9)').textContent = new Date(s.updated_at).toLocaleString();
            }
            showAlert('Опрос обновлён', 'success');
        }

        hideModal();
    } catch (err) {
        console.error(err);
        document.getElementById('modalErrors').innerHTML = `<div class="alert alert-danger">Серверная ошибка</div>`;
    }
});

// attach edit/delete listeners for existing rows
function attachRowListeners(root = document){
    root.querySelectorAll('.btn-edit').forEach(btn => {
        btn.removeEventListener('click', onEditClick);
        btn.addEventListener('click', onEditClick);
    });
    root.querySelectorAll('.btn-delete').forEach(btn => {
        btn.removeEventListener('click', onDeleteClick);
        btn.addEventListener('click', onDeleteClick);
    });
}

async function onEditClick(e){
    const id = this.dataset.id;
    try {
        const res = await fetch(`/admin/surveys/${id}/edit`, {
            headers: {'X-CSRF-TOKEN': token, 'Accept': 'application/json'}
        });
        const data = await res.json();
        if(!res.ok) {
            showAlert('Ошибка при загрузке', 'danger');
            return;
        }
        const s = data.survey;
        // populate modal
        document.getElementById('surveyId').value = s.id;
        document.getElementById('title_ru').value = s.title_ru ?? '';
        document.getElementById('title_tj').value = s.title_tj ?? '';
        document.getElementById('title_en').value = s.title_en ?? '';
        document.getElementById('description_ru').value = s.description_ru ?? '';
        document.getElementById('is_active').checked = s.is_active ? true : false;

        showModal('edit');
    } catch (err) {
        console.error(err);
        showAlert('Ошибка сети', 'danger');
    }
}

async function onDeleteClick(e){
    const id = this.dataset.id;
    if(!confirm('Удалить опрос?')) return;
    try {
        const res = await fetch(`/admin/surveys/${id}`, {
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': token}
        });
        if(!res.ok){
            showAlert('Ошибка при удалении', 'danger');
            return;
        }
        // remove row
        const row = document.querySelector(`#surveysTable tr[data-id="${id}"]`);
        if(row) row.remove();
        showAlert('Опрос удалён', 'success');
    } catch (err) {
        console.error(err);
        showAlert('Ошибка сети', 'danger');
    }
}

function showAlert(text, type='success'){
    const box = document.getElementById('alerts');
    box.innerHTML = `<div class="alert alert-${type}">${text}</div>`;
    setTimeout(()=> box.innerHTML = '', 3500);
}

function escapeHtml(text){
    if(!text) return '';
    return String(text).replace(/[&<>"'`=\/]/g, function (s) {
        return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;'}[s];
    });
}

attachRowListeners();

</script>

@endsection

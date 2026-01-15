@extends('admin.admin_dashboard')
@section('admin')

@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<div class="content">
    <div class="container-fluid">
        <h4 class="mb-3">Медиабиблиотека</h4>

        <div class="d-flex justify-content-between mb-3">
            <div>
                <button type="button" id="btn-back" class="btn btn-sm btn-outline-secondary">⬅ Назад</button>
                <button type="button" id="btn-new-folder" class="btn btn-sm btn-outline-primary">+ Папка</button>
            </div>

            <select id="sort-select" class="form-select form-select-sm" style="width:150px;">
                <option value="name" {{ $sort=='name' ? 'selected' : '' }}>По имени</option>
                <option value="date" {{ $sort=='date' ? 'selected' : '' }}>По дате</option>
                <option value="type" {{ $sort=='type' ? 'selected' : '' }}>По типу</option>
            </select>
        </div>

        <form action="{{ route('media.upload') }}" class="dropzone mb-3" id="mediaDropzone">
            @csrf
            <input type="hidden" name="path" id="current-path" value="{{ $path }}">
        </form>

        <div id="media-content">
            @include('backend.media._content')
        </div>
    </div>
</div>

<script>
    // globals
    let currentPath = "{{ $path }}";
    let currentSort = "{{ $sort }}";
    let historyStack = [currentPath];

    // load partial
    async function loadMedia(path = '', sort = 'name', pushHistory = true) {
        path = path ? path.replace(/^\/|\/$/g, '') : '';
        if (pushHistory && currentPath !== path) historyStack.push(currentPath);
        currentPath = path;
        document.getElementById('current-path').value = currentPath;

        const res = await fetch("{{ route('media.index') }}?ajax=1&path=" + encodeURIComponent(currentPath) + "&sort=" + sort, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!res.ok) {
            document.getElementById('media-content').innerHTML = '<div class="text-danger">Ошибка загрузки ('+res.status+')</div>';
            return;
        }

        const html = await res.text();
        document.getElementById('media-content').innerHTML = html;
        initMediaHandlers();
    }

    // assign handlers to items in #media-content
    function initMediaHandlers() {
        // open folder
        document.querySelectorAll('.open-folder').forEach(btn => {
            btn.onclick = e => {
                e.preventDefault();
                loadMedia(btn.dataset.path, currentSort, true);
            };
        });

        // file selectable (click to select -> postMessage to parent or copy)
        document.querySelectorAll('.file-selectable').forEach(el => {
            el.onclick = e => {
                e.preventDefault();
                const link = el.dataset.link;
                if (window.parent && window.parent !== window) {
                    window.parent.postMessage({ action: 'media_select', link }, '*');
                } else {
                    navigator.clipboard.writeText(link);
                    alert('Ссылка скопирована: ' + link);
                }
            };
        });

        // copy link button
        document.querySelectorAll('.copy-link').forEach(btn => {
            btn.onclick = e => {
                e.preventDefault();
                const link = btn.dataset.link;
                navigator.clipboard.writeText(link).then(() => {
                    btn.innerText = 'Скопировано';
                    setTimeout(()=> btn.innerText = 'Копировать', 1200);
                });
            };
        });

        // delete
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.onclick = async e => {
                e.preventDefault();
                if (!confirm('Удалить?')) return;

                const target = btn.dataset.path;
                btn.disabled = true;
                const oldText = btn.innerText;
                btn.innerText = '⌛';

                try {
                    const res = await fetch("{{ route('media.delete') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ target })
                    });

                    if (!res.ok) {
                        const txt = await res.text();
                        console.error(txt);
                        throw new Error('HTTP ' + res.status);
                    }

                    const json = await res.json();
                    if (json.success) {
                        // гарантируем, что файл удалён на сервере — небольшая пауза
                        setTimeout(() => loadMedia(currentPath, currentSort, false), 250);
                    } else {
                        alert(json.message || 'Ошибка удаления');
                    }
                } catch (err) {
                    alert('Ошибка запроса: ' + err.message);
                } finally {
                    btn.disabled = false;
                    btn.innerText = oldText;
                }
            };
        });

        // rename
        document.querySelectorAll('.rename-btn').forEach(btn => {
            btn.onclick = async e => {
                e.preventDefault();
                const oldPath = btn.dataset.path;
                const oldName = btn.dataset.name;
                const newName = prompt('Новое имя:', oldName);
                if (!newName || newName === oldName) return;

                try {
                    const res = await fetch("{{ route('media.rename') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ old_path: oldPath, new_name: newName })
                    });

                    const json = await res.json();
                    if (json.success) loadMedia(currentPath, currentSort, false);
                    else alert(json.message || 'Ошибка');
                } catch (err) {
                    alert('Ошибка: ' + err.message);
                }
            };
        });
    }

    // controls
    document.getElementById('btn-back').addEventListener('click', () => {
        if (historyStack.length === 0) return;
        const prev = historyStack.pop();
        loadMedia(prev, currentSort, false);
    });

    document.getElementById('btn-new-folder').addEventListener('click', async () => {
        const name = prompt('Имя новой папки:');
        if (!name) return;
        const res = await fetch("{{ route('media.createFolder') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ path: currentPath, folder_name: name })
        });
        const json = await res.json();
        if (json.success) loadMedia(currentPath, currentSort, false);
        else alert(json.message || 'Ошибка создания папки');
    });

    document.getElementById('sort-select').addEventListener('change', e => {
        currentSort = e.target.value;
        loadMedia(currentPath, currentSort, false);
    });

    // Dropzone
    Dropzone.options.mediaDropzone = {
        paramName: 'file',
        maxFilesize: 50,
        init: function() {
            this.on('success', function(file, resp) {
                // resp - json from controller
                setTimeout(() => loadMedia(currentPath, currentSort, false), 300);
            });
        }
    };

    // initial handlers for first server-rendered content
    initMediaHandlers();
</script>

@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
<i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
<div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif

@endsection

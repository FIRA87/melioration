@extends('admin.admin_dashboard')
@section('admin')

    <div class="content">
        <div class="container-fluid">

            <h4 class="mb-3">Медиабиблиотека</h4>

            <!-- Панель управления -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button class="btn btn-sm btn-outline-primary" id="btn-back">⬅ Назад</button>
                    <button class="btn btn-sm btn-outline-success" id="btn-new-folder">+ Папка</button>
                </div>

                <select id="sort-select" class="form-select form-select-sm" style="width:auto;">
                    <option value="name">По имени</option>
                    <option value="date">По дате</option>
                    <option value="type">По типу</option>
                </select>
            </div>

            <!-- Dropzone -->
            <form action="{{ route('media.upload') }}" class="dropzone border rounded p-3 mb-4" id="mediaDropzone">
                @csrf
                <input type="hidden" name="path" id="current-path" value="">
            </form>

            <!-- Контейнер контента -->
            <div id="media-content" class="mt-3 text-center text-muted">
                <div class="spinner-border" role="status"></div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script>
        const contentDiv = document.getElementById('media-content');
        let currentPath = '';
        let currentSort = 'name';
        let historyStack = [];

        async function loadMedia(path = '', sort = 'name') {
            currentPath = path;
            document.getElementById('current-path').value = path;
            contentDiv.innerHTML = `<div class="spinner-border" role="status"></div>`;

            const res = await fetch(`{{ route('media.index') }}?path=${encodeURIComponent(path)}&sort=${sort}&ajax=1`);
            const html = await res.text();
            contentDiv.innerHTML = html;

            document.querySelectorAll('.open-folder').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    historyStack.push(currentPath);
                    loadMedia(btn.dataset.path, currentSort);
                });
            });

            document.querySelectorAll('.copy-link').forEach(btn => {
                btn.addEventListener('click', () => {
                    navigator.clipboard.writeText(btn.dataset.link);
                    btn.innerText = '✅ Скопировано';
                    setTimeout(() => btn.innerText = 'Копировать', 1500);
                });
            });

            document.querySelectorAll('.rename-btn').forEach(btn => {
                btn.addEventListener('click', async e => {
                    e.preventDefault();
                    const oldPath = btn.dataset.path;
                    const oldName = btn.dataset.name;
                    const newName = prompt('Новое имя:', oldName);
                    if (!newName || newName === oldName) return;
                    await fetch('{{ route('media.rename') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ old_path: oldPath, new_name: newName })
                    });
                    loadMedia(currentPath, currentSort);
                });
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', async e => {
                    e.preventDefault();
                    if (!confirm('Удалить?')) return;
                    await fetch('{{ route('media.delete') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ _method: 'DELETE', target: btn.dataset.path })
                    });
                    loadMedia(currentPath, currentSort);
                });
            });
        }

        document.getElementById('sort-select').addEventListener('change', e => {
            currentSort = e.target.value;
            loadMedia(currentPath, currentSort);
        });

        document.getElementById('btn-back').addEventListener('click', () => {
            if (historyStack.length > 0) {
                const prev = historyStack.pop();
                loadMedia(prev, currentSort);
            }
        });

        document.getElementById('btn-new-folder').addEventListener('click', async () => {
            const name = prompt('Имя новой папки:');
            if (!name) return;
            await fetch('{{ route('media.createFolder') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ path: currentPath, folder_name: name })
            });
            loadMedia(currentPath, currentSort);
        });

        Dropzone.options.mediaDropzone = {
            paramName: "file",
            maxFilesize: 10,
            acceptedFiles: "image/*,video/*,application/pdf,.zip,.rar,.doc,.docx",
            success: () => setTimeout(() => loadMedia(currentPath, currentSort), 800)
        };

        // Первичная загрузка
        loadMedia();
    </script>

@endsection

<div class="text-start mb-2">
    <strong>Путь:</strong> /{{ $path ?: 'media' }}
</div>

<div class="row">
    @foreach($folders as $folder)
        <div class="col-md-3 mb-3 text-center">
            <div class="border rounded p-3 bg-light open-folder" data-path="{{ $folder['path'] }}" style="cursor:pointer;">
                📁 <div class="fw-bold mt-2">{{ $folder['name'] }}</div>
            </div>
            <div class="mt-2">
                <button class="btn btn-sm btn-outline-secondary rename-btn" data-path="{{ $folder['path'] }}" data-name="{{ $folder['name'] }}">✏️</button>
                <button class="btn btn-sm btn-outline-danger delete-btn" data-path="{{ $folder['path'] }}">🗑</button>
            </div>
        </div>
    @endforeach

    @foreach($files as $file)
        <div class="col-md-3 mb-3 text-center">
            @if(preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $file['name']))
                <img src="{{ $file['path'] }}" class="img-fluid rounded border mb-2" style="max-height:120px;">
            @else
                <div class="border rounded p-4 bg-light">📄</div>
            @endif
            <div class="small text-truncate">{{ $file['name'] }}</div>
            <div class="btn-group mt-2">
                <button class="btn btn-sm btn-outline-primary copy-link" data-link="{{ $file['path'] }}">Копировать</button>
                <button class="btn btn-sm btn-outline-secondary rename-btn" data-path="{{ trim($path . '/' . $file['name'], '/') }}" data-name="{{ $file['name'] }}">✏️</button>
                <button class="btn btn-sm btn-outline-danger delete-btn" data-path="{{ trim($path . '/' . $file['name'], '/') }}">🗑</button>
            </div>
        </div>
    @endforeach
</div>

@if(empty($folders) && empty($files))
    <div class="text-muted mt-4">Папка пуста</div>
@endif

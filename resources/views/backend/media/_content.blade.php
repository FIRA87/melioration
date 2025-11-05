<div class="mb-2"><strong>Путь:</strong> /{{ $path ?: 'media' }}</div>

<div class="row">
    @foreach($folders as $folder)
        <div class="col-md-3 mb-3 text-center">
            <a href="#" class="open-folder" data-path="{{ $folder['path'] }}">
                <div class="border rounded p-4 bg-light">📁</div>
            </a>
            <div class="small text-truncate">{{ $folder['name'] }}</div>
            <div class="btn-group mt-2">
                <button type="button" class="btn btn-sm btn-outline-secondary rename-btn"
                        data-path="{{ $folder['path'] }}" data-name="{{ $folder['name'] }}">✏️</button>
                <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                        data-path="{{ $folder['path'] }}">🗑</button>
            </div>
        </div>
    @endforeach

    @foreach($files as $file)
        <div class="col-md-3 mb-3 text-center">
            @if(preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $file['name']))
                <a href="#" class="file-selectable" data-link="{{ $file['path'] }}">
                    <img src="{{ $file['path'] }}" class="img-fluid rounded border mb-2" style="max-height:120px;">
                </a>
            @else
                <a href="#" class="file-selectable" data-link="{{ $file['path'] }}">
                    <div class="border rounded p-4 bg-light">📄</div>
                </a>
            @endif
            <div class="small text-truncate">{{ $file['name'] }}</div>
            <div class="btn-group mt-2">
                <button type="button" class="btn btn-sm btn-outline-primary copy-link" data-link="{{ $file['path'] }}">Копировать</button>
                <button type="button" class="btn btn-sm btn-outline-secondary rename-btn"
                        data-path="{{ $path ? $path . '/' . $file['name'] : $file['name'] }}" data-name="{{ $file['name'] }}">✏️</button>
                <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                        data-path="{{ $path ? $path . '/' . $file['name'] : $file['name'] }}">🗑</button>
            </div>
        </div>
    @endforeach
</div>

@if(empty($folders) && empty($files))
    <div class="text-muted mt-4">Папка пуста</div>
@endif

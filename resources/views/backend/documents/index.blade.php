@extends('admin.admin_dashboard')
@section('admin')
    <div class="container py-4">
        <h3>Документы</h3>
        <a href="{{ route('documents.create') }}" class="btn btn-success mb-3">Добавить документ</a>

        <table id="basic-datatable" class="table dt-responsive nowrap w-100">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Название (RU)</th>
                    <th>Описание (RU)</th>
                    <th>Дата публикации</th>
                    <th>Файл</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $doc)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $doc->title_ru }} </td>
                        <td>{{ Str::limit($doc->description_ru), 50 }}
                        </td>
                        <td>{{ $doc->published_at?->format('d.m.Y') ?? '-' }}</td>
                        <td>
                            @if ($doc->file_path)
                                @php
                                    $ext = strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION));
                                    $icon = match ($ext) {
                                        'pdf' => 'fa-file-pdf',
                                        'doc', 'docx' => 'fa-file-word',
                                        'xls', 'xlsx' => 'fa-file-excel',
                                        default => 'fa-file',
                                    };
                                @endphp
                                <a href="{{ route('documents.download', $doc) }}" target="_blank">
                                    <i class="fa {{ $icon }}"></i> {{ basename($doc->file_path) }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($doc->is_active)
                                <span class="badge bg-success">Активен</span>
                            @else
                                <span class="badge bg-secondary">Неактивен</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('documents.edit', $doc) }}" class="btn btn-sm btn-primary">Редактировать</a>

                            <form action="{{ route('documents.destroy', $doc) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Удалить документ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Документы не найдены</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
@endpush

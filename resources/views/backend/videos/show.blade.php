@extends('admin.admin_dashboard')
@section('heading', 'Videos')

@section('admin')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Видео</span> </h4>
            <div class="card">
                <h5 class="card-header">
                    <span> Table Caption</span>
                    <span class="d-flex justify-content-end">   <a href="{{ route('add.video') }}" class="btn btn-primary">  Добавлять  </a></span>
                </h5>

                <div class="table-responsive text-nowrap">

                    <table class="table">
                        <caption class="ms-4">
                            Список
                        </caption>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Видео</th>
                            <th>Обложка</th>
                            <th>Порядок</th>
                            <th>Статус</th>
                            <th>Язык</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $item)
                            <tr>
                                <td><span class="badge badge-center rounded-pill bg-primary"> <strong>{{ $item->id }}</strong></span>  </td>
                                <td>
                                    <iframe style="width: 300px; height: 150px" width="560" height="315" src="https://www.youtube.com/embed/{{ $item->video_id }}" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </td>
                                <td> {{ $item->caption }} </td>
                                <td>{{ $item->order }}</td>
                                <td>
                                    <span class="badge bg-label-primary me-1">
                                        @if($item->status == '1')
                                            <p>Show</p>
                                        @else
                                            <p>No</p>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @if($item->Language->short_name ==  'RU')
                                        <span class="badge bg-label-primary me-1">{{ $item->Language->short_name }}</span>
                                    @elseif($item->Language->short_name ==  'EN')
                                        <span class="badge bg-label-info me-1">{{ $item->Language->short_name }}</span>
                                    @else
                                        <span class="badge bg-label-warning me-1">{{ $item->Language->short_name }}</span>
                                    @endif
                                </td>
                            <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="{{ route('video_edit', $item->id)  }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="{{ route('video_delete', $item->id)  }}" onclick="return confirm('Are you sure ?')">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

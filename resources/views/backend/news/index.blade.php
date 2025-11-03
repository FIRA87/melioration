@extends('admin.admin_dashboard')
@section('admin')


    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('add.news') }}" class="btn btn-blue waves-effect waves-light text-white">Добавить</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Все новости<span class="btn btn-danger"> {{ count($allNews) }}</span>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Изображение</th>
                                    <th>Заголовок </th>
                                    <th>Категория</th>
                                    <th>Пользователь</th>
                                    <th>Дата</th>
                                    <th>Статус</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($allNews as $key=> $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <img src="{{ asset($item->image) }}"
                                                 class="rounded-circle avatar-lg img-thumbnail" alt="profile-image"
                                                 style="height: 100px; width: 100px;">
                                        </td>
                                        <td title="{{ $item->title_ru }}">{{ Str::limit($item->title_ru, 30) }}</td>
                                        <td>{{ $item->category->title_ru  }}</td>
                                        <td> {{ $item->user->name  }}</td>
                                        <td> {{ $item->publish_date }}</td>

                                        <td>
                                            @if($item->status == 1)
                                                <span class="btn btn-success rounded-pill waves-effect waves-light">Активный</span>
                                            @else
                                                <span class="btn btn-danger waves-effect waves-light">Неактивный</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit.news', $item->id) }}"
                                               class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>   </a>

                                            <form action="{{ route('delete.news', $item) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger waves-effect waves-light"
                                                        onclick="return confirm('Удалить новость?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>

                                            @if($item->status == 1)
                                                <a href="{{ route('inactive.news', $item->id) }}"
                                                   class="btn btn-primary waves-effect waves-light"
                                                   title="Неактивный"><i class="fa-solid fa-thumbs-down"></i></a>
                                            @else
                                                <a href="{{ route('active.news', $item->id) }}"
                                                   class="btn btn-primary waves-effect waves-light" title="Активный "><i
                                                            class="fa-solid fa-thumbs-up"></i></a>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->


    <script>
        $(document).ready(function () {
            $('#basic-datatable').DataTable({
                order: [['id', 'desc']],
            });
        });
    </script>

@endsection

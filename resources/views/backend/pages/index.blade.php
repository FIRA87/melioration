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
                                <li class="breadcrumb-item"><a href="{{ route('add.pages') }}" class="btn btn-blue waves-effect waves-light text-white">Добавить </a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Страницы</h4>
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
                                    <th>Название RU</th>
                                    <th>Адрес страницы</th>
                                    <th>Статус</th>
								   <th>Сортировка</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id}}</td>
                                    <td>{{ $page->title_ru }} </td>

                                    <td>{{ $page->url }}</td>
                                    <td>
                                        @if($page['status'] == 1)
                                            <a class="updatePageStatus" id="page-{{ $page['id'] }}"  page_id="{{ $page["id"] }}"  href="javascript:void(0)" >
                                                <i class="fas fa-toggle-on" style="font-size: 34px; color: #3f6ed3" status="Active" ></i>
                                            </a>
                                        @else
                                            <a class="updatePageStatus" id="page-{{ $page['id'] }}"  page_id="{{ $page["id"] }}"  href="javascript:void(0)"  >
                                            <i class="fas fa-toggle-off" style="color: gray;font-size: 34px" status="InActive"></i>
                                            </a>
                                        @endif
                                    </td>
									<td>{{ $page->sort }}</td>
                                    <td>
                                        <a href="{{ route('edit.pages', $page->id) }}" class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>   </a>
                                        <a href="{{ route('delete.pages', $page->id) }}" class="btn btn-danger waves-effect waves-light" id="delete"> <i class="fa-solid fa-trash"></i> </a>
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

  </script>
@endsection

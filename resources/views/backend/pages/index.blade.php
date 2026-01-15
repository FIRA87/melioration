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
                                @if(Auth::user()->can('menu.add'))
                                <li class="breadcrumb-item"><a href="{{ route('add.pages') }}" class="btn btn-blue waves-effect waves-light text-white">Добавить </a></li>
                                @endif

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
                             
                                    <th>Действия</th>
                                
                                </tr>
                                </thead>


                                <tbody>
                                   
                                @foreach($allPages as $page)
                                
                                
                                <tr>
                                    <td>{{ $page->id}}</td>
                                    <td>{{ $page->title_ru }} </td>

                                    <td>{{ $page->url }}</td>
                                    <td>
                                         @if ($page->status == 1)
                                            <span class="badge bg-success">Активный</span>
                                        @else
                                            <span class="badge bg-danger">Неактивный</span>
                                        @endif
                                    </td>
									<td>{{ $page->sort }}</td>
                                  @if(Auth::user()->can('menu.menu'))
                                    <td>
@if(Auth::user()->can('menu.add'))
    <a href="{{ route('edit.page', $page->id) }}" class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>   </a>
@endif

@if(Auth::user()->can('menu.edit'))
    <a href="{{ route('delete.page', $page->id) }}" class="btn btn-danger waves-effect waves-light" id="delete"> <i class="fa-solid fa-trash"></i> </a>
@endif
                                    </td>
                                    @endif
                               
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

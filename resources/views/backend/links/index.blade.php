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
                            @if(Auth::user()->can('links.add'))
                            <li class="breadcrumb-item"><a href="{{ route('add.links') }}"
                                    class="btn btn-blue waves-effect waves-light text-white">Добавить </a></li>
                            @endif        
                        </ol>
                    </div>
                    <h4 class="page-title">Ссылки</h4>
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
									<th>Категория</th> 	
                                    <th>Изображение</th>
                                    <th>Дата</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($links as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td title="{{ $item->title_ru }}">
                                            {{ \Illuminate\Support\Str::limit($item->title_ru, 30) }} </td>
											
										<td>
											@if($item->type == 1)
												Наши партнёры
											@else
												Основатель
											@endif
										
										</td>

										
                             
                                        <td> <img src="{{ asset($item->img) }}" alt="" class="img-fluid"
                                                style="max-width: 100px;"> </td>
                                        <td>{{ $item->created_at }}</td>

                                         @if(Auth::user()->can('links.list'))
                                        <td>
                                             @if(Auth::user()->can('links.add'))
                                            <a href="{{ route('edit.links', $item->id) }}"
                                                class="btn btn-primary waves-effect waves-light"><i class="fa-solid fa-pen"></i>  </a>
                                                @endif


                                            @if(Auth::user()->can('links.delete'))
                                           <form action="{{ route('delete.links', $item->id) }}" method="POST" style="display:inline;"  >
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger waves-effect waves-light delete-btn" >
													<i class="fa-solid fa-trash"></i>
												</button>
											</form>
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

    	document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                if (!confirm('Вы действительно хотите удалить?')) {
                    e.preventDefault();
                }
            });
        });
    });

</script>


@endsection

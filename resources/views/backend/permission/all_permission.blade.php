@extends('admin.admin_dashboard')
@section('admin')



 
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Все разрешения</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Все разрешения</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
						@if(Auth::user()->can('add_roles_permission'))
							<a href="{{ route('add.permission') }}" class="btn btn-primary">Добавить</a>
						@endif
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="basic-datatable" class="table table-striped table-bordered" style="width:100%">
								<thead>
					<tr>
		                <th>Sl</th>
		                <th> Имя разрешения </th>
		                <th> Имя группы </th>
		                <th> Действия </th>
					</tr>
		</thead>
		<tbody>
	@foreach($permissions as $key => $item)
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->name }}</td>
				<td>{{ $item->group_name }}</td>

				<td>
					@if(Auth::user()->can('all_roles_permission'))
                    	<a href="{{ route('edit.permission',$item->id) }}" class="btn btn-info"><i class="fa-solid fa-pen"></i></a>
 					@endif

                    @if(Auth::user()->can('all_roles_permission'))
                    	<a href="{{ route('delete.permission',$item->id) }}" class="btn btn-danger" id="delete" ><i class="fa-solid fa-trash"></i> </a>
                   @endif
				</td>
			</tr>
			@endforeach


		</tbody>
		<tfoot>
			<tr>
                <th>Sl</th>
                <th> Имя разрешения </th>
                <th> Имя группы </th>
                <th> Действия </th>
			</tr>
		</tfoot>
	</table>
			</div>
		</div>
	</div>



</div>




@endsection

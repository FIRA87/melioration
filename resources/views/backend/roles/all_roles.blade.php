@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Все роли</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Все роли</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('add.roles') }}" class="btn btn-primary">Добавить роли</a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
			<tr>
                <th>Sl</th>
                <th> Имя роли </th>
                <th> Действия </th>
			</tr>
		</thead>
		<tbody>
	@foreach($roles as $key => $item)
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->name }}</td>

				<td>
<a href="{{ route('edit.roles',$item->id) }}" class="btn btn-info">Редактировать</a>
<a href="{{ route('delete.roles',$item->id) }}" class="btn btn-danger" id="delete" >Удалить</a>

				</td>
			</tr>
			@endforeach


		</tbody>
		<tfoot>
			<tr>
                <th>Sl</th>
                <th> Имя роли </th>
                <th> Действия </th>
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>



			</div>




@endsection

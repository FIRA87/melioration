@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Разрешение редактирования </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Разрешение редактирования </li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">

					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">

<div class="col-lg-10">
	<div class="card">
		<div class="card-body">

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<form id="myForm" method="post" action="{{ route('update.permission') }}"  >
			@csrf
		 <input type="hidden" name="id" value="{{ $permission->id }}">

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Имя разрешения</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}"   />
				</div>
			</div>


			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Название группы</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<select name="group_name" class="form-select mb-3" aria-label="Default select example">
	<option selected="">Откройте эту группу</option>
	<option value="brand" {{ $permission->group_name == 'brand' ? 'selected': ''}}>Бренд</option>
	<option value="category"{{ $permission->group_name == 'category' ? 'selected': ''}}>Категория</option>
	<option value="subcategory"{{ $permission->group_name == 'subcategory' ? 'selected': ''}}>Подкатегория</option>
	<option value="product"{{ $permission->group_name == 'product' ? 'selected': ''}}>Продукт</option>
	<option value="slider"{{ $permission->group_name == 'slider' ? 'selected': ''}}>Слайдер</option>
	<option value="ads"{{ $permission->group_name == 'ads' ? 'selected': ''}}>Реклама</option>
	<option value="coupon"{{ $permission->group_name == 'coupon' ? 'selected': ''}}>Купон</option>
	<option value="area"{{ $permission->group_name == 'area' ? 'selected': ''}}>Страна</option>
	<option value="vendor"{{ $permission->group_name == 'vendor' ? 'selected': ''}}>Поставщик</option>
	<option value="order"{{ $permission->group_name == 'order' ? 'selected': ''}}>Заказ</option>
	<option value="return"{{ $permission->group_name == 'return' ? 'selected': ''}}>Возврат</option>
	<option value="report"{{ $permission->group_name == 'report' ? 'selected': ''}}>Отчет</option>
	<option value="user"{{ $permission->group_name == 'user' ? 'selected': ''}}>Управление пользователями</option>
	<option value="review"{{ $permission->group_name == 'review' ? 'selected': ''}}>Обзор</option>
	<option value="setting"{{ $permission->group_name == 'setting' ? 'selected': ''}}>Настройка</option>
	<option value="blog"{{ $permission->group_name == 'blog' ? 'selected': ''}}>Блог</option>
	<option value="role"{{ $permission->group_name == 'role' ? 'selected': ''}}>Роль</option>
	<option value="admin"{{ $permission->group_name == 'admin' ? 'selected': ''}}>Администратор</option>
	<option value="stock"{{ $permission->group_name == 'stock' ? 'selected': ''}}>Запасы</option>
				</select>
				</div>
			</div>




			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 text-secondary">
					<input type="submit" class="btn btn-primary px-4" value="Сохранить изменения" />
				</div>
			</div>
        </form>
		</div>

	</div>




                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Введите имя разрешения',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>






@endsection

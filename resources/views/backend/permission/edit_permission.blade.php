@extends('admin.admin_dashboard')
@section('admin')


@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 
 
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
	
<option value="media" {{ $permission->group_name == 'media' ? 'selected': ''}}>Медиабиблиотека</option>
<option value="menu" {{ $permission->group_name == 'menu' ? 'selected': ''}}>Меню</option>
<option value="submenu" {{ $permission->group_name == 'submenu' ? 'selected': ''}}>Подменю</option>
<option value="leader" {{ $permission->group_name == 'leader' ? 'selected': ''}}>Руководство</option>
<option value="leader" {{ $permission->group_name == 'leader' ? 'selected': ''}}>Категория</option>
<option value="links" {{ $permission->group_name == 'links' ? 'selected': ''}}>Партнёры</option>
<option value="news" {{ $permission->group_name == 'news' ? 'selected': ''}}>Новости</option>
<option value="video" {{ $permission->group_name == 'video' ? 'selected': ''}}>Видео</option>
<option value="gallery" {{ $permission->group_name == 'gallery' ? 'selected': ''}}>Галерея</option>
<option value="presidents" {{ $permission->group_name == 'presidents' ? 'selected': ''}}>Президент</option>
<option value="projects" {{ $permission->group_name == 'projects' ? 'selected': ''}}>Проекты</option>
<option value="tasks" {{ $permission->group_name == 'tasks' ? 'selected': ''}}>Задачи</option>
<option value="services" {{ $permission->group_name == 'services' ? 'selected': ''}}>Услуги</option>
<option value="surveys" {{ $permission->group_name == 'surveys' ? 'selected': ''}}>Голосования</option>
<option value="contacts" {{ $permission->group_name == 'contacts' ? 'selected': ''}}>Форма обратной связи</option>
<option value="jobs" {{ $permission->group_name == 'jobs' ? 'selected': ''}}>Вакансия</option>
<option value="documents" {{ $permission->group_name == 'documents' ? 'selected': ''}}>Документы</option>
<option value="setting" {{ $permission->group_name == 'setting' ? 'selected': ''}}>Настройка сайта</option>
<option value="admin" {{ $permission->group_name == 'admin' ? 'selected': ''}}>Пользователи</option>
<option value="permission" {{ $permission->group_name == 'permission' ? 'selected': ''}}>Роли и права/Все разрешения</option>
<option value="roles" {{ $permission->group_name == 'roles' ? 'selected': ''}}>Роли  пользователей</option>
<option value="add_roles_permission" {{ $permission->group_name == 'add_roles_permission' ? 'selected': ''}}>Добавить разрешение для роли</option>
<option value="all_roles_permission" {{ $permission->group_name == 'all_roles_permission' ? 'selected': ''}}>Все роли с разрешениями</option>
<option value="static_translations" {{ $permission->group_name == 'static_translations' ? 'selected': ''}}>Статические переводы</option>

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




@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif

@endsection

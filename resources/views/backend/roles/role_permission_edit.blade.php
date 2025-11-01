@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('all.subcategory') }}">Назад</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Редактировать роль в разрешениях</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Редактировать роль в разрешениях</h4>
                            <form id="myForm" method="POST" action="{{ route('role.permission.update', $role->id) }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class=" form-group mb-3">
                                            <label for="group_name" class="form-label">Все роли</label>
                                            <h4>{{ $role->name }}</h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check mb-2 form-check-primary">
                                                <input class="form-check-input" type="checkbox" value="" id="customckeck15" >
                                                <label class="form-check-label" for="customckeck15">Все Разрешения</label>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    @foreach($permission_groups as $group)
                                        <div class="row">
                                            <div class="col-2">
                                                @php
                                                    $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                                                @endphp

                                                <div class="form-check mb-2 form-check-primary">
 <input class="form-check-input" type="checkbox" value="" id="customckeck1"
{{ App\Models\User::roleHasPermissions($role, $permissions)? 'checked': '' }} name="permission[]" {{ $role->hasPermissionTo($permission->name) ? 'checked': ''}}>
                                                    <label class="form-check-label" for="customckeck1">{{ $group->group_name }}</label>
                                                </div>
                                            </div>


                                            <div class="col-2">
                                                @foreach($permissions as $item)
                                                    <div class="form-check mb-2 form-check-primary">
<input class="form-check-input" name="permission[]"  {{ $role->hasPermissionTo($item->name) ? 'checked' : ''}} type="checkbox" value="{{ $item->id }}" id="customckeck{{ $item->id }}" >
<label class="form-check-label" for="customckeck1">{{ $item->name }}</label>
                                                    </div>
                                                @endforeach
                                                <br>
                                            </div>

                                        </div>
                                    @endforeach
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Сохранить</button>
                                    </div>
                                </div>
                                <!-- end row-->
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->

    </div> <!-- content -->


    <script>
        $('#customckeck15').click(function(){

            if($(this).is(':checked')) {
                $('input[type = checkbox]').prop('checked', true)
            } else {
                $('input[type = checkbox]').prop('checked', false)
            }

        })
    </script>



@endsection

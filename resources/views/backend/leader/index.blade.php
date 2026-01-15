@extends('admin.admin_dashboard')
@section('admin')



<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="page-title-right">
                 @if(Auth::user()->can('leader.add'))
                <a href="{{ route('leader.create') }}" class="btn btn-primary waves-effect waves-light"> 
                    <i class="mdi mdi-plus-circle"></i> Добавить руководителя  
                 </a>
                 @endif
            </div>
            <h4 class="page-title">Руководящий состав</h4>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="basic-datatable" class="table table-bordered table-striped align-middle dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th width="80">Фото</th>
                        <th>ФИО (RU)</th>
                        <th>Должность</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th width="150">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($leaders as $item)
                        <tr>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" width="60" height="60" class="rounded-circle" style="object-fit:cover;">
                                @else
                                    <img src="{{ asset('upload/no-image.jpg') }}" width="60" height="60" class="rounded-circle">
                                @endif
                            </td>
                            <td>{{ $item->title_ru }}</td>
                            <td>{{ $item->position_ru }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                @if(Auth::user()->can('leader.edit'))
                                <a href="{{ route('leader.edit', $item->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-pencil"></i></a>
                              @endif

                                @if(Auth::user()->can('leader.delete'))
                                <form action="{{ route('leader.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Удалить запись?')" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Нет данных</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection

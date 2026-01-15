@extends('admin.admin_dashboard')
@section('admin')


<div class="content">
    <div class="container-fluid">
        <h4 class="mb-4">Заявки на услуги</h4>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Услуга</th>
                <th>Комментарий</th>
                <th>Дата</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $key => $req)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $req->fio }}</td>
                    <td>{{ $req->phone }}</td>
                    <td>{{ $req->service->title_ru ?? '-' }}</td>
                    <td>{{ $req->comment }}</td>
                    <td>{{ $req->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('delete.service.request', $req->id) }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('Удалить заявку?')">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection

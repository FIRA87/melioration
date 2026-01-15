@extends('admin.admin_dashboard')
@section('admin')


<div class="content">
    <div class="container-fluid">
        <h4>Сообщения с формы обратной связи</h4>

        <table class="table table-bordered mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->title_ru }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        @if(Auth::user()->can('contacts.add'))
                            <a href="{{ route('contacts.show', $c->id) }}" class="btn btn-sm btn-info">Просмотр</a>
                        @endif

                        @if(Auth::user()->can('surveys.delete'))
                            <form action="{{ route('contacts.destroy', $c->id) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Удалить сообщение?')" class="btn btn-sm btn-danger">Удалить</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $contacts->links() }}
    </div>
</div>


   
@endsection

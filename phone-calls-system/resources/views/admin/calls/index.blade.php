@extends('layouts.app')

@section('title', 'Адміністрування дзвінків')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Список дзвінків</h1>
            <a href="{{ route('admin.calls.create') }}" class="btn btn-success">Додати дзвінок</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Клієнт</th>
                    <th>Телефон</th>
                    <th>Тривалість</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calls as $call)
                    <tr>
                        <td>{{ $call->id }}</td>
                        <td>{{ $call->client }}</td>
                        <td>{{ $call->phone }}</td>
                        <td>{{ $call->duration }} хв</td>
                        <td>
                            <a href="{{ route('admin.calls.show', $call) }}" class="btn btn-info btn-sm">Перегляд</a>

                            <form action="{{ route('admin.calls.destroy', $call) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
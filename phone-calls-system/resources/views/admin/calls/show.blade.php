@extends('layouts.app')

@section('title', 'Деталі дзвінка')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Деталі дзвінка</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $call->id }}</p>
                <p><strong>Клієнт:</strong> {{ $call->client }}</p>
                <p><strong>Телефон:</strong> {{ $call->phone }}</p>
                <p><strong>Тривалість:</strong> {{ $call->duration }} хв</p>
            </div>
        </div>

        <a href="{{ route('admin.calls.index') }}" class="btn btn-secondary mt-3">Назад</a>
    </div>
@endsection
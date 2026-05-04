@extends('layouts.app')

@section('title', 'Додати дзвінок')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Додати новий дзвінок</h1>

        <form action="{{ route('admin.calls.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="client" class="form-label">Клієнт</label>
                <input
                    type="text"
                    name="client"
                    id="client"
                    class="form-control @error('client') is-invalid @enderror"
                    value="{{ old('client') }}"
                >
                @error('client')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}"
                >
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Тривалість (хв)</label>
                <input
                    type="number"
                    name="duration"
                    id="duration"
                    class="form-control @error('duration') is-invalid @enderror"
                    value="{{ old('duration') }}"
                >
                @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Зберегти</button>
            <a href="{{ route('admin.calls.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
@endsection
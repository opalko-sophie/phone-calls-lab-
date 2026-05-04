@extends('layouts.app')

@section('title', 'Дзвінки')

@section('content')
    <h1>Список дзвінків</h1>

    @foreach($calls as $call)
        <x-card :client="$call['client']" :phone="$call['phone']" />
    @endforeach
@endsection
@props(['client', 'phone'])

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $client }}</h5>
        <p class="card-text">Номер телефону: {{ $phone }}</p>
    </div>
</div>
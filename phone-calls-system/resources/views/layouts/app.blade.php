<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Phone Calls')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a href="/" class="navbar-brand">Phone Calls</a>

        <div class="d-flex align-items-center gap-3">
            <a href="/" class="text-white text-decoration-none">Головна</a>

            @auth
                <a href="{{ route('admin.calls.index') }}" class="text-white text-decoration-none">Адмінка</a>
                <span class="text-white">Користувач: {{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-light">Вихід</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="text-white text-decoration-none">Вхід</a>
                <a href="{{ route('register') }}" class="text-white text-decoration-none">Реєстрація</a>
            @endguest
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    © 2026 Phone Calls System
</footer>

</body>
</html>
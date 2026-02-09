<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Kibardjaya Pennant')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-neutral-900">

    <header class="border-b">
        <div class="max-w-6xl mx-auto flex justify-between items-center p-4">
            <a href="/" class="font-bold text-lg">Kibardjaya</a>
            <nav class="flex gap-4">
                <a href="/shop">Shop</a>
                <a href="/about">About</a>
                <a href="/cart">Cart</a>
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto p-4">
        @yield('content')
    </main>

    <footer class="border-t mt-16">
        <div class="max-w-6xl mx-auto p-4 text-sm text-center">
            © {{ date('Y') }} Kibardjaya
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
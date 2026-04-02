<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Golf Buddy</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 flex flex-col min-h-screen">

    {{-- Navbar pubblica --}}
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-green-700">⛳ Golf Buddy</a>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-700">Accedi</a>
            <a href="{{ route('register') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Registrati
            </a>
        </div>
    </nav>

    {{-- Contenuto --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <span class="text-xl font-bold text-green-700">⛳ Golf Buddy</span>
            <p class="text-gray-500 text-sm text-center">
                Fatto con ☕ da <span class="font-medium text-gray-700">Jacopo</span> —
                {{ now()->year }}
            </p>
            <p class="text-gray-400 text-xs">Tutti i diritti riservati</p>
        </div>
    </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100 dark:bg-gray-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Project Management App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-full antialiased font-sans">
    <div id="app">
        {{-- Navigation Bar --}}
        <nav class="bg-white dark:bg-gray-800 shadow-sm py-4">
            <div class="container mx-auto flex justify-between items-center px-4">
                <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800 dark:text-white">Project App</a>
                <div>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold px-4 py-2 rounded-lg transition duration-150 ease-in-out">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Daftar</a>
                    @else
                        {{-- Jika sudah login, bisa tampilkan nama user atau tautan ke dashboard --}}
                        <span class="text-gray-600 dark:text-gray-300 mr-4">Halo, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Keluar</button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>

        {{-- Konten Utama Aplikasi Anda akan di-inject di sini --}}
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Neural Matrix') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full antialiased bg-black">
    <div id="app" class="min-h-full">
        {{-- Check if current route is login or register for full-screen layout --}}
        @if(request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('password.request'))
            {{-- Full-screen layout for auth pages --}}
            @yield('content')
        @else
            {{-- Regular layout with navigation for other pages --}}
            <div class="min-h-full bg-gray-900">
                {{-- Futuristic Navigation Bar --}}
                <nav class="relative bg-gray-900/95 backdrop-blur-xl border-b border-gray-700/50 shadow-lg">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/5 via-purple-500/5 to-pink-500/5"></div>
                    
                    <div class="relative container mx-auto flex justify-between items-center px-4 py-4">
                        {{-- Logo/Brand --}}
                        <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-purple-500 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent font-mono">
                                NEURAL.MATRIX
                            </span>
                        </a>

                        {{-- Navigation Links --}}
                        <div class="flex items-center space-x-1">
                            @guest
                                <a href="{{ route('login') }}" 
                                   class="relative px-4 py-2 text-gray-300 hover:text-cyan-400 font-medium transition-all duration-200 rounded-lg hover:bg-gray-800/50 group">
                                    <span class="relative z-10 font-mono text-sm">CONNECT</span>
                                    <div class="absolute inset-0 bg-cyan-500/10 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                </a>
                                <a href="{{ route('register') }}" 
                                   class="relative px-4 py-2 bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-semibold rounded-lg hover:from-cyan-400 hover:to-purple-500 transition-all duration-200 transform hover:scale-105 font-mono text-sm">
                                    REGISTER
                                </a>
                            @else
                                {{-- User Menu --}}
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2 px-3 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                                        <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-cyan-400 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-bold text-gray-900">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-gray-300 text-sm font-medium font-mono">{{ Auth::user()->name }}</p>
                                            <p class="text-gray-500 text-xs font-mono">STATUS: ACTIVE</p>
                                        </div>
                                    </div>
                                    
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="relative px-4 py-2 bg-red-600/80 hover:bg-red-500 text-white font-medium rounded-lg transition-all duration-200 border border-red-500/50 hover:border-red-400/50 font-mono text-sm group">
                                            <span class="relative z-10">DISCONNECT</span>
                                            <div class="absolute inset-0 bg-red-500/20 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                        </button>
                                    </form>
                                </div>
                            @endguest
                        </div>
                    </div>
                </nav>

                {{-- Main Content Area --}}
                <main class="relative min-h-screen bg-gray-900">
                    {{-- Background Effects --}}
                    <div class="absolute inset-0 overflow-hidden pointer-events-none">
                        <div class="absolute top-20 left-20 w-32 h-32 bg-cyan-400/10 rounded-full blur-3xl animate-pulse"></div>
                        <div class="absolute bottom-20 right-20 w-40 h-40 bg-purple-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-60 h-60 bg-pink-400/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 4s;"></div>
                    </div>

                    {{-- Grid Overlay --}}
                    <div class="absolute inset-0 opacity-5 pointer-events-none">
                        <div class="h-full w-full bg-grid-pattern"></div>
                    </div>

                    {{-- Content --}}
                    <div class="relative z-10">
                        @yield('content')
                    </div>
                </main>
            </div>
        @endif
    </div>

    {{-- Matrix Rain Effect Script --}}
    <script>
        // Matrix rain effect for background
        function createMatrixRain() {
            if (window.location.pathname.includes('login') || window.location.pathname.includes('register')) {
                return; // Don't run on auth pages
            }
            
            const chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const container = document.querySelector('body');
            
            for (let i = 0; i < 20; i++) {
                const char = document.createElement('div');
                char.textContent = chars[Math.floor(Math.random() * chars.length)];
                char.style.cssText = `
                    position: fixed;
                    top: -100px;
                    left: ${Math.random() * 100}vw;
                    color: rgba(6, 182, 212, 0.1);
                    font-family: 'JetBrains Mono', monospace;
                    font-size: ${Math.random() * 20 + 10}px;
                    pointer-events: none;
                    z-index: 1;
                    animation: matrix-rain ${10 + Math.random() * 5}s linear infinite;
                    animation-delay: ${Math.random() * 5}s;
                `;
                container.appendChild(char);
                
                // Remove after animation
                setTimeout(() => {
                    if (char.parentNode) {
                        char.parentNode.removeChild(char);
                    }
                }, 15000);
            }
        }

        // Initialize matrix rain
        document.addEventListener('DOMContentLoaded', function() {
            // Create initial matrix rain
            createMatrixRain();
            
            // Continue creating matrix rain periodically
            setInterval(createMatrixRain, 3000);
        });
    </script>

    <style>
        /* Grid pattern utility */
        .bg-grid-pattern {
            background-image: 
                linear-gradient(rgba(6,182,212,0.3) 1px, transparent 1px), 
                linear-gradient(90deg, rgba(6,182,212,0.3) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</body>
</html>
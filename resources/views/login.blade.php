@extends('layouts.app')

@section('content')
<div class="min-h-screen relative overflow-hidden bg-black">
    <!-- Animated Background Effects -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-black to-purple-900/50"></div>
        <div class="absolute inset-0" style="background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.8) 100%)"></div>
    </div>

    <!-- Grid Pattern Overlay -->
    <div class="absolute inset-0 opacity-10">
        <div class="h-full w-full" 
             style="background-image: linear-gradient(rgba(6,182,212,0.2) 1px, transparent 1px), 
                    linear-gradient(90deg, rgba(6,182,212,0.2) 1px, transparent 1px); 
                    background-size: 50px 50px;">
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <!-- Login Card -->
            <div class="relative group">
                <!-- Glow Effect -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500 rounded-2xl blur opacity-30 group-hover:opacity-70 transition duration-1000"></div>
                
                <!-- Card Content -->
                <div class="relative bg-gray-900/80 backdrop-blur-xl p-8 rounded-2xl border border-gray-700/50">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-cyan-500 to-purple-500 mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                            System Login
                        </h2>
                        <p class="text-gray-400 text-sm mt-2">Access your dashboard</p>
                    </div>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Email Input -->
                        <div class="space-y-2">
                            <label class="text-gray-300 text-sm">Email</label>
                            <div class="relative group">
                                <input type="email" 
                                       name="email" 
                                       class="w-full bg-gray-800/50 border border-gray-700/50 rounded-lg px-4 py-3 text-gray-100 focus:outline-none focus:border-cyan-500 transition duration-300"
                                       required>
                                <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-cyan-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition duration-300 pointer-events-none"></div>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="space-y-2">
                            <label class="text-gray-300 text-sm">Password</label>
                            <div class="relative group">
                                <input type="password" 
                                       name="password" 
                                       class="w-full bg-gray-800/50 border border-gray-700/50 rounded-lg px-4 py-3 text-gray-100 focus:outline-none focus:border-purple-500 transition duration-300"
                                       required>
                                <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition duration-300 pointer-events-none"></div>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-2 text-sm text-gray-400">
                                <input type="checkbox" name="remember" class="form-checkbox bg-gray-800 border-gray-700">
                                <span>Remember me</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="text-sm text-cyan-400 hover:text-cyan-300">
                                Forgot password?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-cyan-500 to-purple-500 text-white font-medium py-3 px-4 rounded-lg hover:from-cyan-400 hover:to-purple-400 transition duration-300 transform hover:scale-[1.02]">
                            Login
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="mt-6 text-center text-gray-400 text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300">
                            Register here
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes pulse-glow {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

.animate-glow {
    animation: pulse-glow 2s infinite;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(31, 41, 55, 0.5);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #06b6d4, #8b5cf6);
    border-radius: 4px;
}
</style>
@endsection
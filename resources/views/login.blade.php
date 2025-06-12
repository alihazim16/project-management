{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app') {{-- Pastikan Anda memiliki layout 'app' atau sesuaikan --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-400 to-indigo-600 p-4 sm:p-6 lg:p-8">
    <div class="bg-white p-8 sm:p-10 rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 hover:scale-105">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-2">Selamat Datang</h2>
            <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 text-sm" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 text-sm" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-2 list-disc list-inside text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Alamat Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    autofocus
                    placeholder="nama@contoh.com"
                >
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Kata Sandi</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-800 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('password') border-red-500 @enderror"
                    required
                    autocomplete="current-password"
                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"
                >
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-gray-700 text-sm cursor-pointer">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-2 select-none">Ingat Saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="inline-block align-baseline font-semibold text-sm text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out" href="{{ route('password.request') }}">
                        Lupa Kata Sandi?
                    </a>
                @endif
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg"
            >
                Masuk
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-8">
            Belum punya akun?
            <a class="font-bold text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out" href="{{ route('register') }}">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection

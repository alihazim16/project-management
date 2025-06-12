{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app') {{-- Pastikan Anda memiliki layout 'app' atau sesuaikan --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 p-4 sm:p-6 lg:p-8">
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-10 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 w-full max-w-md transform transition-all duration-300 hover:scale-[1.01]">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Daftar Akun Baru</h2>
            <p class="text-gray-600 dark:text-gray-400">Buat akun Anda untuk mulai mengelola proyek</p>
        </div>

        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 text-sm" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 text-sm" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-2 list-disc list-inside text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Nama Lengkap</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    autofocus
                    placeholder="Nama Lengkap Anda"
                >
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Alamat Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="nama@contoh.com"
                >
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Kata Sandi</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm @error('password') border-red-500 @enderror"
                    required
                    autocomplete="new-password"
                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"
                >
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Konfirmasi Kata Sandi</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm"
                    required
                    autocomplete="new-password"
                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg"
            >
                Daftar
            </button>
        </form>

        <p class="text-center text-gray-600 dark:text-gray-400 text-sm mt-8">
            Sudah punya akun?
            <a class="font-bold text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out" href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection

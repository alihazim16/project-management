{{-- resources/views/projects/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6 text-center">Edit Proyek: {{ $project->name }}</h1>

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

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk metode PUT/PATCH --}}

            <div class="mb-5">
                <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Nama Proyek</label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required
                    class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm">
                @error('name')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm">{{ old('description', $project->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="start_date" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') : '') }}"
                        class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm">
                    @error('start_date')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="due_date" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Tanggal Jatuh Tempo</label>
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $project->due_date ? \Carbon\Carbon::parse($project->due_date)->format('Y-m-d') : '') }}"
                        class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm">
                    @error('due_date')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="status" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Status</label>
                <select name="status" id="status" required
                    class="block w-full px-4 py-2.5 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm">
                    <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>Dalam Progres</option>
                    <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                @error('status')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('projects.show', $project->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-md transition duration-200">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200">Perbarui Proyek</button>
            </div>
        </form>
    </div>
</div>
@endsection

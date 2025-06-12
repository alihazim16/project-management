{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Dashboard Proyek</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
            + Tambah Proyek Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if($projects->isEmpty())
        <div class="text-center bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <p class="text-gray-600 dark:text-gray-400 text-lg">Anda belum memiliki proyek. Mari buat yang pertama!</p>
            <a href="{{ route('projects.create') }}" class="mt-4 inline-block bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200 ease-in-out">
                Buat Proyek Pertama Anda
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 ease-in-out p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $project->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ Str::limit($project->description, 100) ?? 'Tidak ada deskripsi.' }}</p>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                            <p>Status: <span class="font-medium @if($project->status == 'completed') text-green-600 @elseif($project->status == 'in_progress') text-blue-600 @elseif($project->status == 'pending') text-yellow-600 @else text-red-600 @endif">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span></p>
                            <p>Mulai: {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '-' }}</p>
                            <p>Jatuh Tempo: {{ $project->due_date ? \Carbon\Carbon::parse($project->due_date)->format('d M Y') : '-' }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <a href="{{ route('projects.show', $project->id) }}" class="flex-grow bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium py-2 px-3 rounded-lg text-center transition duration-150">Detail</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="flex-grow bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium py-2 px-3 rounded-lg text-center transition duration-150">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini? Tindakan ini tidak dapat dibatalkan!');" class="flex-grow">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-2 px-3 rounded-lg transition duration-150">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

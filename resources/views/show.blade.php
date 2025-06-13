{{-- resources/views/projects/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        {{-- Back to Dashboard Button --}}
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-4">{{ $project->name }}</h1>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-6">
            <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Deskripsi:</strong> {{ $project->description ?? 'Tidak ada deskripsi.' }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Status:</strong> 
                <span class="font-semibold @if($project->status == 'completed') text-green-600 @elseif($project->status == 'in_progress') text-blue-600 @elseif($project->status == 'pending') text-yellow-600 @else text-red-600 @endif">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </p>
            <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Tanggal Mulai:</strong> {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '-' }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Jatuh Tempo:</strong> {{ $project->due_date ? \Carbon\Carbon::parse($project->due_date)->format('d M Y') : '-' }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Dibuat oleh:</strong> {{ $project->user->name ?? 'N/A' }}</p>

            <div class="mt-4 flex space-x-2">
                <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition duration-150">
                    Edit Proyek
                </a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini? Tindakan ini tidak dapat dibatalkan!');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-150">
                        Hapus Proyek
                    </button>
                </form>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-3">Daftar Tugas</h2>
        <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block transition duration-150">
            Tambah Tugas Baru
        </a>

        @if($project->tasks->isEmpty())
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center">
                <p class="text-gray-600 dark:text-gray-400">Belum ada tugas untuk proyek ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($project->tasks as $task)
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 task-item-container" data-task-id="{{ $task->id }}">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $task->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ Str::limit($task->description, 80) ?? 'Tidak ada deskripsi.' }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Status: 
                            <span class="font-medium @if($task->status == 'completed') text-green-600 @elseif($task->status == 'in_progress') text-blue-600 @elseif($task->status == 'pending') text-yellow-600 @else text-red-600 @endif">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Jatuh Tempo: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '-' }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Ditugaskan ke: {{ $task->assignee->name ?? 'Belum Ditugaskan' }}</p>
                        <div class="mt-3 flex gap-2">
                            <a href="#" class="text-blue-500 hover:text-blue-700 text-sm font-medium">Detail</a>
                            <a href="#" class="text-yellow-500 hover:text-yellow-700 text-sm font-medium">Edit</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
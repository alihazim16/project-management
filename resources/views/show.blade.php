@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $project->name }}</h1>

        <div class="bg-white p-6 rounded shadow-md mb-6">
            <p class="text-gray-700 mb-2"><strong>Deskripsi:</strong> {{ $project->description ?? 'Tidak ada deskripsi.' }}</p>
            <p class="text-gray-700 mb-2"><strong>Status:</strong> <span class="font-semibold text-blue-600">{{ ucfirst($project->status) }}</span></p>
            <p class="text-gray-700 mb-2"><strong>Tanggal Mulai:</strong> {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '-' }}</p>
            <p class="text-gray-700 mb-2"><strong>Jatuh Tempo:</strong> {{ $project->due_date ? \Carbon\Carbon::parse($project->due_date)->format('d M Y') : '-' }}</p>
            <p class="text-gray-700 mb-2"><strong>Dibuat oleh:</strong> {{ $project->user->name ?? 'N/A' }}</p>

            <div class="mt-4 flex space-x-2">
                <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Edit Proyek
                </a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Hapus Proyek
                    </button>
                </form>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-3">Daftar Tugas</h2>
        <a href="{{-- route('tasks.create', ['project_id' => $project->id]) --}}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Tambah Tugas Baru
        </a>

        @if($project->tasks->isEmpty())
            <p class="text-gray-600">Belum ada tugas untuk proyek ini.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($project->tasks as $task)
                    {{-- Tambahkan class 'task-item-container' dan data-task-id --}}
                    <div class="bg-white p-4 rounded shadow-md cursor-pointer hover:shadow-lg transition-shadow duration-200 task-item-container" data-task-id="{{ $task->id }}">
                        <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ $task->description ?? 'Tidak ada deskripsi.' }}</p>
                        <p class="text-gray-500 text-xs">Status: <span class="font-medium">{{ ucfirst($task->status) }}</span></p>
                        <p class="text-gray-500 text-xs">Jatuh Tempo: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '-' }}</p>
                        <p class="text-gray-500 text-xs">Ditugaskan ke: {{ $task->assignee->name ?? 'Belum Ditugaskan' }}</p>
                        <div class="mt-3">
                            <a href="{{-- route('tasks.show', $task->id) --}}" class="text-blue-500 hover:text-blue-700 text-sm mr-2">Detail</a>
                            <a href="{{-- route('tasks.edit', $task->id) --}}" class="text-yellow-500 hover:text-yellow-700 text-sm">Edit</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

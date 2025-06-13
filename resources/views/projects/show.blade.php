@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    {{-- Back Navigation --}}
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Dashboard
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $project->name }}</h1>
            <div class="flex gap-2">
                <a href="{{ route('projects.edit', $project->id) }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-150">
                    Edit Project
                </a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-150"
                            onclick="return confirm('Are you sure you want to delete this project?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Description</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->description ?? 'No description provided.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Status</h3>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($project->status == 'completed') bg-green-100 text-green-800
                        @elseif($project->status == 'in_progress') bg-blue-100 text-blue-800
                        @elseif($project->status == 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Dates</h3>
                    <div class="space-y-1 text-sm text-gray-600 dark:text-gray-400">
                        <p>Started: {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : 'Not set' }}</p>
                        <p>Due: {{ $project->due_date ? \Carbon\Carbon::parse($project->due_date)->format('d M Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
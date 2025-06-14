<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Depan - Langsung redirect ke login jika belum auth
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Langsung ke halaman login sebagai halaman utama
    return redirect()->route('login');
});

// Rute Autentikasi Laravel UI
Auth::routes();

// Redirect /home ke dashboard setelah login
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('home');

// Grup rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard utama
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
    
    // Resource routes untuk projects (CRUD lengkap)
    Route::resource('projects', ProjectController::class);
    
    // Jika Anda memiliki TaskController, uncomment baris berikut:
    // Route::resource('tasks', TaskController::class);
    
    // Rute tambahan jika diperlukan
    Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
});

// Hapus fallback route yang menyebabkan masalah logout
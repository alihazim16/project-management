<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController; // Anda perlu membuat TaskController
use App\Http\Controllers\HomeController; // Tambahkan ini, karena Auth::routes() biasanya membuat HomeController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rute Halaman Depan
Route::get('/', function () {
    // Jika user sudah login, arahkan ke dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Jika belum, tampilkan halaman welcome
    return view('welcome');
});

// Rute Autentikasi yang disediakan oleh Laravel UI
// Ini akan mendaftarkan rute seperti /login, /register, /logout, /home
Auth::routes();

// Rute khusus untuk dashboard (diarahkan ke ProjectController@index)
// Jika user mengakses /home setelah login (default dari Auth::routes), kita redirect ke dashboard
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('home'); // Beri nama 'home' agar redirect dari Auth::routes() bekerja

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute dashboard utama, sekarang mengarah ke ProjectController@index
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');

    // Rute Resource untuk Proyek (mencakup CRUD)
    Route::resource('projects', ProjectController::class);

    // Rute Resource untuk Tugas (Anda perlu membuat TaskController)
    // Route::resource('tasks', TaskController::class);
});

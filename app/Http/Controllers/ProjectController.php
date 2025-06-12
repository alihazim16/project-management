<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User; // Tambahkan ini untuk relasi assigned_to di tasks
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Tampilkan daftar proyek untuk pengguna yang login.
     * Ini akan menjadi halaman dashboard utama.
     */
    public function index()
    {
        // Pastikan pengguna sudah login sebelum mengambil proyek
        if (Auth::check()) {
            $projects = Auth::user()->projects()->latest()->get();
        } else {
            // Jika belum login, kembalikan ke halaman login
            return redirect()->route('login');
        }

        return view('dashboard', compact('projects')); // Menggunakan 'dashboard' view
    }

    /**
     * Tampilkan form untuk membuat proyek baru.
     */
    public function create()
    {
        // Hanya pengguna yang login yang bisa membuat proyek
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('projects.create');
    }

    /**
     * Simpan proyek baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        // Buat proyek dan kaitkan dengan user yang sedang login
        Auth::user()->projects()->create($request->all());

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dibuat!');
    }

    /**
     * Tampilkan detail proyek tertentu.
     */
    public function show(Project $project)
    {
        // Pastikan hanya pemilik proyek yang bisa melihat detailnya
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Akses ditolak jika bukan pemilik
        }

        // Muat tasks yang terkait dengan proyek ini
        $project->load('tasks.assignee'); // Memuat tugas dan juga penugasan user-nya

        return view('projects.show', compact('project'));
    }

    /**
     * Tampilkan form untuk mengedit proyek yang sudah ada.
     */
    public function edit(Project $project)
    {
        // Pastikan hanya pemilik proyek yang bisa mengedit
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Perbarui proyek di database.
     */
    public function update(Request $request, Project $project)
    {
        // Pastikan hanya pemilik proyek yang bisa memperbarui
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        // Perbarui data proyek
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    /**
     * Hapus proyek dari database.
     */
    public function destroy(Project $project)
    {
        // Pastikan hanya pemilik proyek yang bisa menghapus
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus!');
    }
}

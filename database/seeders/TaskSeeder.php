<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;    // Pastikan baris ini ada
use App\Models\Project; // Pastikan baris ini ada
use App\Models\User;    // Pastikan baris ini ada

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $users = User::all();

        // Jika tidak ada proyek, panggil ProjectSeeder terlebih dahulu
        if ($projects->isEmpty()) {
            $this->call(ProjectSeeder::class);
            $projects = Project::all(); // Muat ulang proyek setelah seeder dijalankan
        }
        // Jika tidak ada user, panggil UserSeeder terlebih dahulu
        if ($users->isEmpty()) {
            $this->call(UserSeeder::class);
            $users = User::all(); // Muat ulang user setelah seeder dijalankan
        }

        // Buat tugas dummy untuk setiap proyek
        foreach ($projects as $project) {
            // Buat antara 2 sampai 7 tugas acak untuk setiap proyek
            Task::factory()->count(rand(2, 7))->make()->each(function ($task) use ($project, $users) {
                $task->project_id = $project->id;
                // Pastikan ada user untuk ditugaskan
                if ($users->isNotEmpty()) {
                    $task->assigned_to = $users->random()->id; // Tugaskan ke user acak
                } else {
                    $task->assigned_to = null; // Jika tidak ada user, set null
                }
                $task->save();
            });
        }

        // Contoh tugas spesifik (opsional, bisa dihapus atau diubah)
        // Pastikan project dan user pertama ada sebelum mencoba membuat tugas spesifik ini
        if ($projects->isNotEmpty() && $users->isNotEmpty()) {
            Task::create([
                'project_id' => $projects->first()->id,
                'title' => 'Buat Wireframe Homepage',
                'description' => 'Merancang tata letak visual awal untuk halaman utama.',
                'assigned_to' => $users->first()->id,
                'status' => 'todo',
                'due_date' => now()->addDays(5),
                'priority' => 2, // High
            ]);
        }
    }
}

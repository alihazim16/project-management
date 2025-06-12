<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project; // Pastikan ini di-import
use App\Models\User;    // Pastikan ini di-import

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa user yang sudah ada
        $users = User::all();

        // Jika tidak ada user, buat setidaknya satu
        if ($users->isEmpty()) {
            User::factory()->create();
            $users = User::all();
        }

        // Buat proyek dummy
        Project::factory()->count(10)->make()->each(function ($project) use ($users) {
            $project->user_id = $users->random()->id; // Kaitkan dengan user acak
            $project->save();
        });

        // Contoh proyek spesifik
        Project::create([
            'user_id' => $users->first()->id, // Kaitkan dengan user pertama
            'name' => 'Pengembangan Aplikasi Mobile',
            'description' => 'Membangun aplikasi seluler lintas platform untuk iOS dan Android.',
            'start_date' => now()->subDays(30),
            'due_date' => now()->addDays(60),
            'status' => 'in_progress',
        ]);

        Project::create([
            'user_id' => $users->first()->id,
            'name' => 'Desain Ulang Website Perusahaan',
            'description' => 'Memperbarui tampilan dan fungsionalitas website utama perusahaan.',
            'start_date' => now()->subDays(15),
            'due_date' => now()->addDays(45),
            'status' => 'pending',
        ]);
    }
}
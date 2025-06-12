<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder Anda di sini sesuai urutan dependensi
        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
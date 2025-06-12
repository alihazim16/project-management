<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan ini di-import

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Password: password
            'email_verified_at' => now(),
        ]);

        // Buat beberapa user dummy lainnya
        User::factory()->count(5)->create(); // Menggunakan factory untuk 5 user acak
    }
}
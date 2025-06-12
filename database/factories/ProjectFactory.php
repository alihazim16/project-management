<?php

namespace Database\Factories; // <-- Pastikan namespace ini benar

use App\Models\Project; // <-- Pastikan import ini benar dan menunjuk ke App\Models\Project
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class; // <-- Pastikan ini menunjuk ke kelas Project yang benar

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $dueDate = $this->faker->dateTimeBetween($startDate, '+1 year');
        $statuses = ['pending', 'in_progress', 'completed', 'cancelled'];

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'start_date' => $startDate,
            'due_date' => $dueDate,
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
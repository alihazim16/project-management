<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['todo', 'in_progress', 'done'];
        $priorities = [0, 1, 2]; // 0=low, 1=medium, 2=high
        $dueDate = $this->faker->dateTimeBetween('now', '+3 months');

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(2),
            'status' => $this->faker->randomElement($statuses),
            'due_date' => $dueDate,
            'priority' => $this->faker->randomElement($priorities),
            // project_id dan assigned_to akan diisi di TaskSeeder
        ];
    }
}
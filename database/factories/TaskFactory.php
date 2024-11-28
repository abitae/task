<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->uuid(),
            'title' => $this->faker->name(),
            'description'=> $this->faker->name(),
            'status' => $this->faker->randomElement(['pendiente','progreso,', 'completada']),
            'priority' => $this->faker->randomElement(['Alta','Media,', 'Baja']),
            'finality' => Carbon::now(),
        ];
    }
}

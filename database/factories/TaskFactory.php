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
            'code' => $this->faker->ean8(),
            'title' => $this->faker->name(),
            'description'=> $this->faker->text(),
            'status' => $this->faker->randomElement(['PENDIENTE','PROGRESO', 'COMPLETADO']),
            'priority' => $this->faker->randomElement(['ALTA','MEDIA,', 'BAJA']),
            'finality' => Carbon::now(),
        ];
    }
}

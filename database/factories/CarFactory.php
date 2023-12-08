<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_model_id' => CarModel::factory(),
            'vehicle_year' => fake()->numberBetween(1900, 2023),
            'mileage' => fake()->numberBetween(1, 500000),
            'color' => fake()->hexColor(),
            'user_id' => User::factory(),
        ];
    }
}

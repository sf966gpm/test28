<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarBrand>
 */
class CarBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'BMW',
                'FORD',
                'TOYOTA',
                'NISSAN',
                'HONDA',
                'VOLKSWAGEN',
                'ACURA',
                'BRILLIANCE',
                'BUGATTI',
                'CHANGAN',
            ]),
        ];
//        return [
//            'name' => fake()->unique()->company()
//        ];
    }
}

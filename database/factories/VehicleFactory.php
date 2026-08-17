<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->word(),
            'model' => $this->faker->word(),
            'class' => $this->faker->randomElement(['Economy', 'Compact', 'Standard', 'SUV', 'Minivan']),
            'status' => 'available',
            'daily_rate' => $this->faker->randomFloat(2, 40, 200),
            'max_passengers' => $this->faker->numberBetween(2, 8),
            'gearbox' => $this->faker->randomElement(['Automatic', 'Manual']),
            'fuel_type' => $this->faker->randomElement(['Gas', 'Diesel', 'Electric']),
            'description' => $this->faker->sentence(),
        ];
    }
}

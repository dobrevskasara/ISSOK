<?php

namespace Database\Factories;

use App\Enums\YachtType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Yacht>
 */
class YachtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(). 'Yacht',
            'type' => $this->faker->randomElement(YachtType::cases()),
            'capacity' => $this->faker->numberBetween(5, 100),
            'hourly_rate' => $this->faker->randomFloat(2, 100, 100),
        ];
    }
}

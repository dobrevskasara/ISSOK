<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Course::class;
    public function definition(): array
    {
        $levels = ['beginner','intermediate','advanced'];

        return [
            'title' => $this->faker->sentence(3),
            'summary' => $this->faker->paragraph,
            'level' => $this->faker->randomElement($levels),
            'start_date' => $this->faker->date(),
            'seats' => $this->faker->numberBetween(5, 30),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Enrollment::class;

    public function definition()
    {
        $course = Course::inRandomOrder()->first() ?? Course::factory()->create();

        return [
            'course_id' => $course->id,
            'student_name' => $this->faker->name,
            'seats_requested' => $this->faker->numberBetween(1,3),
            'status' => 'pending',
        ];
    }
}

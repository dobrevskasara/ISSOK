<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organizer;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     */
    protected $model = Event::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'type' => $this->faker->randomElement(['seminar', 'workshop', 'lecture']),
            'date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'organizer_id' => \App\Models\Organizer::factory(),
        ];
    }
}

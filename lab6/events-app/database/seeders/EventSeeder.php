<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Organizer;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
//    public function run(): void
//    {
//        $faker = Faker::create();
//        $organizers = Organizer::all();
//
//        foreach ($organizers as $organizer) {
//            for ($i = 0; $i < 2; $i++) {
//                Event::create([
//                    'name' => $faker->sentence(3),
//                    'description' => $faker->paragraph(2),
//                    'type' => $faker->randomElement(['seminar', 'workshop', 'lecture']),
//                    'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
//                    'organizer_id' => $organizer->id,
//                ]);
//            }
//        }
//    }

    public function run(): void
    {
        Event::factory(10)->create();
    }
}

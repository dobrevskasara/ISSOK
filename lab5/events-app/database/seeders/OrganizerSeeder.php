<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organizer;
use Faker\Factory as Faker;

class OrganizerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Organizer::create([
                'full_name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
            ]);
        }
    }
}

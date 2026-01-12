<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Review;
use App\Models\Yacht;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Yacht::factory(5)->create();
        Reservation::factory(5)->create();
        Review::factory(5)->create();
    }
}

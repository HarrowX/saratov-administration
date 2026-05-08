<?php

namespace Database\Seeders;

use App\Models\GuidedTour;
use Illuminate\Database\Seeder;

class GuidedTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $guidedTours = [];

        for ($i = 0; $i < 8; $i++) {
            $guidedTours[] = [
                'name' => fake()->name(),
                'short_description' => fake()->realText(30),
                'description' => fake()->realText(),
                'experience' => fake()->numberBetween(1, 15).' лет',
                'phone' => fake()->phoneNumber(),
                'email' => fake()->email(),
            ];
        }
        GuidedTour::query()->insert($guidedTours);
    }
}

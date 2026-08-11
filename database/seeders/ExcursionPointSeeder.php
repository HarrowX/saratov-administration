<?php

namespace Database\Seeders;

use App\Models\Attraction;
use App\Models\CustomPoint;
use App\Models\Excursion;
use App\Models\ExcursionPoint;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class ExcursionPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $excursions = Excursion::all();

        foreach ($excursions as $excursion) {
            $order = 1;

            $attractions = Attraction::query()->inRandomOrder()->take(5)->get();
            foreach ($attractions as $attraction) {
                ExcursionPoint::create([
                    'excursion_id' => $excursion->id,
                    'excursion_pointable_id' => $attraction->id,
                    'excursion_pointable_type' => Attraction::class,
                    'order' => $order++,
                    'duration_minutes' => rand(20, 60),
                ]);
            }

            $hotels = Hotel::query()->inRandomOrder()->take(3)->get();
            foreach ($hotels as $hotel) {
                ExcursionPoint::create([
                    'excursion_id' => $excursion->id,
                    'excursion_pointable_id' => $hotel->id,
                    'excursion_pointable_type' => Hotel::class,
                    'order' => $order++,
                    'duration_minutes' => rand(15, 30),
                ]);
            }

            $restaurants = Restaurant::query()->inRandomOrder()->take(3)->get();
            foreach ($restaurants as $restaurant) {
                ExcursionPoint::create([
                    'excursion_id' => $excursion->id,
                    'excursion_pointable_id' => $restaurant->id,
                    'excursion_pointable_type' => Restaurant::class,
                    'order' => $order++,
                    'duration_minutes' => rand(30, 90),
                ]);
            }

            $customPoints = CustomPoint::query()->inRandomOrder()->take(4)->get();
            foreach ($customPoints as $customPoint) {
                ExcursionPoint::create([
                    'excursion_id' => $excursion->id,
                    'excursion_pointable_id' => $customPoint->id,
                    'excursion_pointable_type' => CustomPoint::class,
                    'order' => $order++,
                    'duration_minutes' => rand(10, 40),
                ]);
            }
        }
    }
}

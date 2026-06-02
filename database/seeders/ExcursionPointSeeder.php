<?php

namespace Database\Seeders;

use App\Models\Attraction;
use App\Models\CustomPoint;
use App\Models\Excursion;
use App\Models\ExcursionPoint;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExcursionPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $excursions = Excursion::all();

        $excursion = $excursions->first();
        $order = 1;

        $attractions = Attraction::take(5)->get();
        foreach ($attractions as $attraction) {
            ExcursionPoint::create([
                'excursion_id' => $excursion->id,
                'pointable_id' => $attraction->id,
                'pointable_type' => Attraction::class,
                'order' => $order++,
                'duration_minutes' => rand(20, 60),
            ]);
        }

        $hotels = Hotel::take(3)->get();
        foreach ($hotels as $hotel) {
            ExcursionPoint::create([
                'excursion_id' => $excursion->id,
                'pointable_id' => $hotel->id,
                'pointable_type' => Hotel::class,
                'order' => $order++,
                'duration_minutes' => rand(15, 30),
            ]);
        }

        $restaurants = Restaurant::take(3)->get();
        foreach ($restaurants as $restaurant) {
            ExcursionPoint::create([
                'excursion_id' => $excursion->id,
                'pointable_id' => $restaurant->id,
                'pointable_type' => Restaurant::class,
                'order' => $order++,
                'duration_minutes' => rand(30, 90),
            ]);
        }

        $customPoints = CustomPoint::take(4)->get();
        foreach ($customPoints as $customPoint) {
            ExcursionPoint::create([
                'excursion_id' => $excursion->id,
                'pointable_id' => $customPoint->id,
                'pointable_type' => CustomPoint::class,
                'order' => $order++,
                'duration_minutes' => rand(10, 40),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Квест',
            'Концерт',
            'Экскурсия',
            'Лекция',
            'Выставка',
            'Выступление',
            'Ярмарка',
            'Конкурс'
        ];
        $events = [];

        for($i = 1; $i < 8; $i++){
            $name = $names[$i];
            $events[] = [
                'name' => $name,
                'description' => fake()->realText(),
                'address' => fake()->address(),
                'age_restriction' => fake()->numberBetween(1,18),
                'start_date' => fake()->dateTime(),
                'end_date' => fake()->dateTime(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
                'slug' => Str::slug($name),
            ];
        }
        Event::query()->insert($events);

        $allEvents = Event::all();
        $categories = EventCategory::all();

        foreach ($allEvents as $event) {
            $randomCategories = $categories->random(rand(1, min(3, $categories->count())));

            foreach ($randomCategories as $category) {
                \DB::table('event_categories')->insert([
                    'event_id' => $event->id,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}

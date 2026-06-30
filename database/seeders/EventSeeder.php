<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'start_date' => fake()->dateTime(),
                'end_date' => fake()->dateTime(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
            ];
        }
        Event::query()->insert($events);
    }
}

<?php

namespace Database\Seeders;

use App\Models\CustomLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Парк культуры и отдыха',
            'Набережная Космонавтов',
            'Смотровая площадка "Орлиное гнездо"',
            'Детский парк "Сказка"',
            'Площадь Ленина',
            'Бульвар Героев',
            'Роща',
            'Старый мост',
            'Фонтан "Времена года"',
            'Спортивный комплекс "Олимпийский"',
        ];

        $locations = [];

        for ($i = 0; $i < count($names); $i++) {
            $name = $names[$i];
            $locations[] = [
                'name' => $name,
                'description' => fake()->realText(),
                'address' => fake()->address(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        CustomLocation::query()->insert($locations);
    }
}

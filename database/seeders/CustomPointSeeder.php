<?php

namespace Database\Seeders;

use App\Models\CustomPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Смотровая площадка',
            'Кофейня "Старый город"',
            'Фонтан на Театральной площади',
            'Смотровая площадка у Волги',
            'Кафе "Речной бриз"',
            'Пляжная зона',
            'Скамейка влюбленных',
            'Лавка купца',
            'Чайная "Дом купца"',
            'Обеденный перерыв',
            'Памятное фото',
            'Кумысная поляна',
            'Журавли',
        ];

        $customPoints = [];

        for ($i = 0; $i < count($names); $i++) {
            $name = $names[$i];
            $customPoints[] = [
                'name' => $name,
                'description' => fake()->realText(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        CustomPoint::query()->insert($customPoints);
    }
}

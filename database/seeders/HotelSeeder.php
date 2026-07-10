<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $names = [
            'Сканди-дачи «Уголок»',
            'Лотос',
            'Хостел День и Ночь',
            'Capsule Hostel Reshka',
            'Гостиница "Словакия"',
            'Глэмпинги «The Chan»',
            'Берег мечты',
            'Горный воздух',
            'Берег солнца',
        ];

        $coords = [
            [51.565446, 45.878625],
            [51.549611, 46.024757],
            [51.530037, 46.033332],
            [51.529371, 46.058044],
            [51.526435, 46.053908],
            [51.614352, 46.201173],
            [58.870000, 121.450000],
            [-56.310000, 141.400000],
        ];

        $hotels = [];

        for ($i = 0; $i < 8; $i++) {
            $name = $names[$i];
            $hotels[] = [
                'name' => $name,
                'type' => fake()->randomElement(['Отель', 'Гостевой дом', 'Глэмпинг', 'Курорт']),
                'description' => fake()->realText(),
                'second_description' => fake()->realText(),
                //                'worktime' => '[]', //'c ' . fake()->time('H:i') . ' до ' . fake()->time('H:i'),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'website' => fake()->url(),
                'latitude' => $coords[$i][0],
                'longitude' => $coords[$i][1],
                'slug' => Str::slug($name),
            ];
        }
        Hotel::query()->insert($hotels);
    }
}

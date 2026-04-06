<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
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
            'Берег солнца'
        ];

        $hotels = [];

        for ($i = 0; $i < 8; $i++) {
            $hotels[] = [
                'name' => fake()->randomElement($names),
                'type' => fake()->randomElement(['Отель', 'Гостевой дом', 'Глэмпинг', 'Курорт']),
                'description' => fake()->realText(),
                'second_description' => fake()->realText(),
//                'worktime' => '[]', //'c ' . fake()->time('H:i') . ' до ' . fake()->time('H:i'),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ];
        }
        Hotel::query()->insert($hotels);
    }
}

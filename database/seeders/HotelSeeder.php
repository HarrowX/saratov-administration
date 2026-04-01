<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

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
        $category = [
            'Дом отдыха',
            'Хостел',
            'Гостиница',
            'Отель'
        ];

        $hotels = [];

        for ($i = 0; $i < 8; $i++) {
            $hotels[] = [
                'name' => fake()->randomElement($names),
                'category' => fake()->randomElement($category),
                'description' => fake()->realText(),
                'secondDescription' => fake()->realText(),
                'worktime' => 'c ' . fake()->time('H:i') . ' до ' . fake()->time('H:i'),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ];
        }
        Hotel::query()->insert($hotels);
    }
}

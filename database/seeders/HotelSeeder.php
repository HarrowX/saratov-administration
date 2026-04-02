<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
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
            $name = fake()->randomElement($names);

            $hotels[] = [
                'name' => $name,
                'category' => fake()->randomElement($category),
                'description' => fake()->realText(),
                'second_description' => fake()->realText(),
                'worktime' => json_encode([
                    'from' => '11:16',
                    'to' => '12:32'
                ]),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),

                'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 10000)),
                'district' => fake()->city(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
                'email' => fake()->safeEmail(),
                'website' => fake()->url(),
                'max_price' => fake()->numberBetween(1000, 10000),
                'min_price' => fake()->numberBetween(500, 1000),
                'rating' => fake()->randomFloat(1, 1, 5),
                'reviews_count' => fake()->numberBetween(0, 500),
                'views_count' => fake()->numberBetween(0, 10000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Hotel::query()->insert($hotels);
    }
}

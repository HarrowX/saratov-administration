<?php

namespace Database\Seeders;

use App\Models\Excursion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ExcursionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Исторический центр города',
            'Автобусная экскурсия по набережным',
            'Велосипедный тур по паркам',
            'Водная прогулка по реке',
            'Комбинированная экскурсия: пешком + автобус',
            'Бесплатная обзорная экскурсия',
            'Ночная экскурсия по городу',
            'Мистический тур по старым кварталам',
            'Гастрономическая экскурсия',
            'Архитектурный вояж',
        ];
        $excursions = [];

        for ($i = 0; $i < 9; $i++) {
            $name = $names[$i];
            $excursions[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => fake()->realText(500),
                'type' => fake()->randomElement(['Пеший', 'Автобусный', 'Велосипедный', 'Водный', 'Комбинированный']),
                'duration' => fake()->numberBetween(60, 360),
                'distance' => fake()->randomFloat(1, 1, 30),
                'difficulty' => fake()->randomElement(['Легко', 'Средне', 'Тяжело']),
                'group_size_min' => fake()->numberBetween(1, 5),
                'group_size_max' => fake()->numberBetween(10, 40),
                'price_adult' => fake()->numberBetween(500, 5000),
                'price_child' => fake()->numberBetween(300, 3000),
                'price_group' => fake()->numberBetween(2000, 20000),
                'is_free' => fake()->boolean(10),
                'age_restriction' => fake()->randomElement(['0+', '3+', '6+', '12+', '16+', null]),
                'meeting_point' => fake()->streetName() . ', ' . fake()->randomElement(['У фонтана', 'У входа', 'У памятника', 'У метро', 'У парковки']),
                'meeting_address' => fake()->address(),
                'schedule_type' => fake()->randomElement(['По расписанию', 'По запросу']),
                'operator_name' => fake()->company(),
                'operator_phone' => fake()->phoneNumber(),
                'booking_enabled' => fake()->boolean(80),
                'status' => fake()->randomElement(['Активный', 'Неактивный', 'Сезонный']),
            ];

        }
        Excursion::query()->insert($excursions);
    }
}

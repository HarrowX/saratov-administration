<?php

namespace Database\Seeders;

use App\Models\Attraction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttractionSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Цирк',
            'Консерватория',
            'Дом книги',
            'Набережная космонавтов',
            'Мост Саратов-Энгельс',
            'Городской парк',
            'Синагога',
            'Пукек',
            'Кумысная поляна',
            'Журавли'
        ];

        $attractions = [];

        for ($i = 0; $i < 8; $i++) {
            $name = fake()->randomElement($names);

            $attractions[] = [
                'name' => $name,
                'short_description' => fake()->realText(30),
                'description' => fake()->realText(),
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
                'status' => fake()->randomElement(['active', 'draft', 'archived']),
                'ticket_price' => fake()->numberBetween(100, 2000),
                'visit_duration' => fake()->numberBetween(30, 240),
                'accessibility' => fake()->boolean(),
                'parking' => fake()->boolean(),
                'rating' => fake()->randomFloat(1, 1, 5),
                'views_count' => fake()->numberBetween(0, 10000),
                'favorites_count' => fake()->numberBetween(0, 500),
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Attraction::query()->insert($attractions);
    }
}

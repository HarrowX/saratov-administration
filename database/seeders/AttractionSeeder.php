<?php

namespace Database\Seeders;

use App\Models\Attraction;
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
            'Журавли',
        ];

        $attractions = [];

        for ($i = 0; $i < 8; $i++) {
            $name = $names[$i];
            $attractions[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'short_description' => fake()->realText(30),
                'description' => fake()->realText(),
                'worktime' => json_encode([
                    'Понедельник' => '10:00-11.00',
                    'Вторник' => '10:00-11.00',
                ]),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'district' => fake()->city(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
                'email' => fake()->safeEmail(),
                'website' => fake()->url(),
                'status' => fake()->randomElement(['active', 'draft', 'archived']),
                'display_location' => fake()->randomElement(['null', 'carousel', 'featured']),
                'ticket_price' => fake()->numberBetween(100, 2000),
                'visit_duration' => fake()->numberBetween(30, 240),
                'accessibility' => fake()->boolean(),
                'parking' => fake()->boolean(),
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

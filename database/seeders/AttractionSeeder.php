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

        $coords = [
            [51.533922, 46.021164],
            [51.529806, 46.034167],
            [51.532515, 46.024274],
            [51.525057, 46.049600],
            [51.517357, 46.070288],
            [51.516337, 46.002929],
            [51.538486, 46.026426],
            [-45.090000, 113.740000],
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
                'latitude' => $coords[$i][0],
                'longitude' => $coords[$i][1],
                'email' => fake()->safeEmail(),
                'website' => fake()->url(),
                'status' => fake()->randomElement(['active', 'draft', 'archived']),
                'display_location' => fake()->randomElement(['null', 'carousel', 'featured']),
                'ticket_price' => fake()->numberBetween(100, 2000),
                'visit_duration' => fake()->numberBetween(30, 240),
                'is_accessible' => fake()->boolean(),
                'has_parking' => fake()->boolean(),
                'views_count' => fake()->numberBetween(0, 10000),
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Attraction::query()->insert($attractions);
    }
}

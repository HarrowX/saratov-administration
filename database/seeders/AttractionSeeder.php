<?php

namespace Database\Seeders;

use App\Models\Attraction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
            $attractions[] = [
                'name' => fake()->randomElement($names),
                'short_description' => fake()->realText(30),
                'description' => fake()->realText(),
                'worktime' => 'c ' . fake()->time('H:i') . ' до ' . fake()->time('H:i'),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ];
        }
        Attraction::query()->insert($attractions);
    }
}

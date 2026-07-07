<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Концерт',
            'Выставка',
            'Фестиваль',
            'Спорт',
            'Культура',
            'Театр',
            'Кино',
            'Мастер-класс',
            'Лекция',
            'Ярмарка',
            'Детское',
            'Городское',
            'Музыка',
            'Семейный',
            'Еда',
            'Образование',
        ];

        $categories = [];

        for ($i = 0; $i < count($names); $i++) {
            $name = $names[$i];
            $categories[] = [
                'name' => $name,
                'is_active' => fake()->boolean(80),
            ];
        }

        EventCategory::query()->insert($categories);
    }
}

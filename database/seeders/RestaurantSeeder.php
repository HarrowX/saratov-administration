<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kitchens = [
            'Русская',
            'Грузинская',
            'Китайская',
            'Французская',
            'Английская',
            'Немецкая',
            'Итальянская',
            'Турецкая',
            'Индийская',
            'Узбекская'
        ];

        $names = [
            'Ресторан «Москва»',
            'Tary-Bary',
            'DURAN Bar&Grill',
            'Khvanch',
            'Kumushka',
            'Тут Харчо Большой',
            'PORT',
            'Старик Хинкалыч',
            'Узбечка'
        ];

        $restaurants = [];

        for ($i = 0; $i < 8; $i++) {
            $restaurants[] = [
                'name' => fake()->randomElement($names),
                'description' => fake()->realText(),
                'address' => fake()->address(),
//                'worktime' => [], //'c ' . fake()->time('H:i') . ' до ' . fake()->time('H:i'),
                'phone' => fake()->phoneNumber(),
                'kitchen' => fake()->randomElement($kitchens)
            ];
        }
        Restaurant::query()->insert($restaurants);
    }
}

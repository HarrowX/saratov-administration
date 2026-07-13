<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'Узбекская',
        ];

        $names = [
            'Ресторан «Москва»',
            'Тары-Бары',
            'DURAN Bar&Grill',
            'Хванч',
            'Кумушка',
            'Тут Харчо Большой',
            'PORT',
            'Старик Хинкалыч',
            'Узбечка',
        ];

        $coords = [
            [51.534808, 46.031979],
            [51.533145, 46.021524],
            [51.530275, 46.033911],
            [51.525903, 46.054624],
            [51.530593, 46.014345],
            [51.531736, 46.025822],
            [51.531103, 46.025938],
            [51.532161, 46.020288],
        ];

        $restaurants = [];

        for ($i = 0; $i < 8; $i++) {
            $name = $names[$i];
            $restaurants[] = [
                'name' => $name,
                'description' => fake()->realText(),
                'address' => fake()->address(),
                'latitude' => $coords[$i][0],
                'longitude' => $coords[$i][1],
                //                'worktime' => [], //'c ' . fake()->time('H:i') . ' до ' . fake()->time('H:i'),
                'phone' => fake()->phoneNumber(),
                'website' => fake()->url(),
                'kitchen' => fake()->randomElement($kitchens),
                'slug' => Str::slug($name),
            ];
        }
        Restaurant::query()->insert($restaurants);
    }
}

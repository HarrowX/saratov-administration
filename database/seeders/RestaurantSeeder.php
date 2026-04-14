<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
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

        $latitude = [

        ];

        $restaurants = [];

        for ($i = 0; $i < 8; $i++) {
            $name = $names[$i];
            $restaurants[] = [
                'name' => $name,
                'description' => fake()->realText(),
                'address' => fake()->address(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
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

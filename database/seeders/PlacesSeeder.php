<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Place::insert([
            [
                'title' => "Саратовская консерватория",
                'description' => "Первая консерватория в российской провинции, основана в 1912 году. Уникальная архитектура и богатая история.",
                'image' => "images/konservatoria.jpeg",
                'time' => "15 мин",
                'category' => "Фотозона",
                'rating' => 4.9,
                'coordinates' => '51.5333, 46.0342'
            ],
            [
                'title' => "Набережная Космонавтов",
                'description' => "Любимое место отдыха горожан с видом на Волгу. Здесь приземлился Юрий Гагарин после первого полёта.",
                'image' => "images/nabereznaya-kosmonavtov.jpeg",
                'time' => "30 мин",
                'category' => "Кафе",
                'rating' => 4.8,
                'coordinates' => '51.5247, 46.0667'
            ],
            [
                'title' => "Парк Победы",
                'description' => "Музей военной техники под открытым небом с уникальной экспозицией и вечным огнем.",
                'image' => "https://saratov.travel/upload/resize_cache/iblock/18c/8glui7vh5ldyyw0g7m2e4xcc3530vuzk/800_800_1/photo_2022-11-14_16-25-54.jpg",
                'time' => "45 мин",
                'category' => "Музей",
                'rating' => 4.7,
                'coordinates' => '51.5555, 45.9567'
            ],
            [
                'title' => "Саратовский мост",
                'description' => "Символ города, один из самых длинных мостов в Европе. Потрясающие виды на Волгу.",
                'image' => "https://photocentra.ru/images/main19/192962_main.jpg",
                'time' => "20 мин",
                'category' => "Фотозона",
                'rating' => 4.9,
                'coordinates' => '51.5066, 46.0077'
            ],
            [
                'title' => "Театр оперы и балета",
                'description' => "Один из старейших театров России с богатой историей и великолепной архитектурой.",
                'image' => "images/teatr-operi-i-baleta.jpeg",
                'time' => "60 мин",
                'category' => "Культура",
                'rating' => 4.8,
                'coordinates' => '51.5294, 46.0354'
            ],
            [
                'title' => "Лимонарий",
                'description' => "Уникальная оранжерея с экзотическими растениями и цитрусовыми деревьями.",
                'image' => "images/limonariy.jpeg",
                'time' => "40 мин",
                'category' => "Парк",
                'rating' => 4.6,
                'coordinates' => '51.5444, 46.0022'
            ],
            [
                'title' => "Музей Радищева",
                'description' => "Первый общедоступный художественный музей в провинции России.",
                'image' => "images/rad-museim.jpeg",
                'time' => "90 мин",
                'category' => "Музей",
                'rating' => 4.7,
                'coordinates' => '51.5289, 46.0333'
            ],
            [
                'title' => "Городской парк",
                'description' => "Центральный парк города с аттракционами, прудом и зелёными аллеями.",
                'image' => "images/gorpark.jpeg",
                'time' => "60 мин",
                'category' => "Парк",
                'rating' => 4.5,
                'coordinates' => '51.5389, 46.0089'
            ],
            [
                'title' => "Проспект Кирова",
                'description' => "Пешеходная улица - 'Саратовский Арбат' с магазинами, кафе и уличными музыкантами.",
                'image' => "images/prospekt-kirova.jpg",
                'time' => "45 мин",
                'category' => "Прогулка",
                'rating' => 4.6,
                'coordinates' => '51.5311, 46.0344'
            ],
            [
                'title' => "Цирк братьев Никитиных",
                'description' => "Первый стационарный цирк в России, основанный в 1876 году.",
                'image' => "images/cirk.jpeg",
                'time' => "90 мин",
                'category' => "Развлечения",
                'rating' => 4.7,
                'coordinates' => '51.5233, 46.0433'
            ],
            [
                'title' => "Национальная деревня",
                'description' => "Этнографический комплекс с домами разных народов Поволжья.",
                'image' => "images/derevnya.jpeg",
                'time' => "60 мин",
                'category' => "Культура",
                'rating' => 4.5,
                'coordinates' => '51.5622, 45.9922'
            ]
        ]);
    }
}

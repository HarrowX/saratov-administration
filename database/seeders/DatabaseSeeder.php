<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use MoonShine\Laravel\Models\MoonshineUser;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        MoonshineUser::create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        $this->call(RestaurantSeeder::class);
        $this->call(GuidedTourSeeder::class);
        $this->call(HotelSeeder::class);
//        $this->call(AttractionSeeder::class);
        $this->call(EventCategorySeeder::class);
        $this->call(EventSeeder::class);
    }
}

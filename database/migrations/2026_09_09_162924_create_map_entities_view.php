<?php

use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW map_entities_view AS
            SELECT id, '".addslashes(Attraction::class)."' AS class, latitude, longitude FROM attractions
            UNION ALL
            SELECT id, '".addslashes(Hotel::class)."' AS class, latitude, longitude FROM hotels
            UNION ALL
            SELECT id, '".addslashes(Restaurant::class)."' AS class, latitude, longitude FROM restaurants
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('
            DROP VIEW map_entities_view;
        ');
    }
};

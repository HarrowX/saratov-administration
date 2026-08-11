<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('location_type', 'eventable_type');
            $table->renameColumn('location_id', 'eventable_id');
        });

        Schema::table('excursion_points', function (Blueprint $table) {
            $table->renameColumn('pointable_type', 'excursion_pointable_type');
            $table->renameColumn('pointable_id', 'excursion_pointable_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('eventable_type', 'location_type');
            $table->renameColumn('eventable_id', 'location_id');
        });

        Schema::table('excursion_points', function (Blueprint $table) {
            $table->renameColumn('excursion_pointable_type', 'pointable_type');
            $table->renameColumn('excursion_pointable_id', 'pointable_id');
        });
    }
};

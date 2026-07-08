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

        Schema::table('excursions', function (Blueprint $table) {
            $table->foreignId('guided_tour_id')->constrained('guided_tours');
            $table->dropColumn(['operator_name', 'operator_phone']);
            $table->integer('duration')->nullable()->change();

        });

        Schema::table('guided_tours', function (Blueprint $table) {
            $table->string('vk')->nullable();
            $table->string('max')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('excursions', function (Blueprint $table) {
            $table->dropColumn('guided_tour_id');
            $table->string('operator_name')->nullable();
            $table->string('operator_phone')->nullable();
            $table->integer('duration')->change();
        });

        Schema::table('guided_tours', function (Blueprint $table) {
            $table->dropColumn(['vk', 'max']);
        });

    }
};

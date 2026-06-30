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
        Schema::table('attractions', function (Blueprint $table) {
            $table->text('yandex_review_widget')->nullable();
        });
        Schema::table('hotels', function (Blueprint $table) {
            $table->text('yandex_review_widget')->nullable();
        });
        Schema::table('restaurants', function (Blueprint $table) {
            $table->text('yandex_review_widget')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropColumn('yandex_review_widget');
        });
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('yandex_review_widget');
        });
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn('yandex_review_widget');
        });
    }
};

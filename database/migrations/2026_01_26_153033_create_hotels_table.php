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

        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('description');
            $table->string('second_description');
            $table->json('worktime');
            $table->string('phone');
            $table->string('address');
            $table->string('slug');
            $table->string('district');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->string('email');
            $table->string('website');
            $table->decimal('max_price');
            $table->decimal('min_price');
            $table->decimal('rating');
            $table->integer('reviews_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};

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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->text('description');
            $table->string('address');
            $table->string('district')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->json('worktime')->nullable();
            $table->text('phone');
            $table->text('kitchen');
            $table->string('website')->nullable();
            $table->enum('price_category',['budget','medium','premium','luxury']);
            $table->integer('capacity');
            $table->decimal('rating');
            $table->integer('reviews_count')->default(0)->nullable();
            $table->integer('views_count')->default(0)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};

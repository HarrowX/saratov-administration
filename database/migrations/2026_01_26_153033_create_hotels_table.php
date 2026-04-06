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
            $table->string('slug')->unique()->nullable();
            $table->text('description');
            $table->string('second_description');
            $table->enum('type',['Отель','Гостевой дом','Глэмпинг','Курорт']);
            $table->tinyInteger('stars')->unsigned()->nullable();
            $table->json('worktime')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('district')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->decimal('max_price')->nullable();
            $table->decimal('min_price')->nullable();
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
        Schema::dropIfExists('hotels');
    }
};

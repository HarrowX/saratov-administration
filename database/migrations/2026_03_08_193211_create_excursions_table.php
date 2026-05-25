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
        Schema::create('excursions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->enum('type', ['Пеший', 'Автобусный', 'Велосипедный', 'Водный', 'Комбинированный']);
            $table->integer('duration'); //продолжительность в минутах
            $table->decimal('distance', 10, 2)->nullable(); //протяженность маршрута в км
            $table->enum('difficulty', ['Легко', 'Средне', 'Тяжело']);
            $table->integer('group_size_min')->nullable();
            $table->integer('group_size_max')->nullable();
            $table->decimal('price_adult', 10, 2)->nullable();
            $table->decimal('price_child', 10, 2)->nullable();
            $table->decimal('price_group', 10, 2)->nullable();
            $table->boolean('is_free')->default(false);
            $table->string('age_restriction')->nullable();
            $table->string('meeting_point')->nullable();
            $table->string('meeting_address')->nullable();
            $table->enum('schedule_type', ['По расписанию', 'По запросу'])->nullable();
            $table->string('operator_name')->nullable();
            $table->string('operator_phone')->nullable();
            $table->boolean('booking_enabled')->nullable();  //бронирование
            $table->decimal('rating')->nullable();
            $table->integer('views_count')->nullable();
            $table->enum('status', ['Активный', 'Неактивный', 'Сезонный'])->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursions');
    }
};

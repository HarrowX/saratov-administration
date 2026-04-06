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
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_description');
            $table->text('description');
            $table->json('worktime');
            $table->string('phone');
            $table->string('address');
            $table->string('slug')->unique()->nullable();
            $table->string('district');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->string('email');
            $table->string('website');
            $table->enum('status',['active','draft','archived'])->default('active');
            $table->char('ticket_price');
            $table->integer('visit_duration');
            $table->boolean('accessibility');
            $table->boolean('parking');
            $table->decimal('rating');
            $table->integer('views_count')->default(0);
            $table->integer('favorites_count')->default(0);
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};

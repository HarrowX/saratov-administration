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
            $table->string('slug');
            $table->string('district');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->string('email');
            $table->string('website');
            $table->enum('status',['active','draft','archived'])->default('active');
            $table->decimal('min_price');
            $table->decimal('max_price');
            $table->decimal('rating');
            $table->boolean('reviews_count');
            $table->decimal('rating');
            $table->integer('views_count')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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

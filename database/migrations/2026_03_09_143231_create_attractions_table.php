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
            $table->json('worktime')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('slug');
            $table->string('district')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->string('email')->nullable();
            $table->string('map_link')->nullable();
            $table->string('website')->nullable();
            $table->enum('status',['active','draft','archived'])->default('active');
            $table->decimal('ticket_price', 10, 2)->nullable();
            $table->integer('visit_duration')->nullable();
            $table->boolean('accessibility')->nullable();
            $table->boolean('parking')->nullable();
            $table->enum('display_location',['null','carousel','featured'])->default('null');
            $table->integer('views_count')->default(0)->nullable();
            $table->integer('favorites_count')->default(0)->nullable();
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

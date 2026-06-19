<?php

use App\Enums\VisitedStatus;
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
        Schema::create('place_visits', function (Blueprint $table) {
            $table->id();
            $table->morphs('visitable');
            $table->foreignId('user_id')->constrained('users');
            $table->string('status')->default(VisitedStatus::SemiVisited);
            $table->timestamps();
            $table->unique(['visitable_id', 'visitable_type', 'user_id']);
        });

        Schema::table('attractions', function (Blueprint $table) {
            $table->decimal('latitude', 10, 6)->nullable()->change();
            $table->decimal('longitude', 10, 6)->nullable()->change();
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->decimal('latitude', 10, 6)->nullable()->change();
            $table->decimal('longitude', 10, 6)->nullable()->change();
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->decimal('latitude', 10, 6)->nullable()->change();
            $table->decimal('longitude', 10, 6)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_visits');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('user_names', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('contact_us', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('user_names', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_names', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->primary('user_id');
            $table->string('surname')->nullable();
            $table->string('name')->nullable();
            $table->string('patronymic')->nullable();
            $table->timestamps();
        });

        if (! Schema::hasColumn('users', 'phone')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone')->nullable()->after('email');
            });
        }

        DB::statement("
            INSERT INTO `user_names` (`user_id`,  `name`, `created_at`, `updated_at`)
            SELECT `id`, `name`, `created_at`, `updated_at` FROM `users`
            ");

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'surname')) {
                $table->dropColumn('surname');
            }
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('users', 'patronymic')) {
                $table->dropColumn('patronymic');
            }
        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
        });

        DB::statement("
            UPDATE `users` u
            JOIN `user_names` un ON u.id = un.user_id
            SET u.name = un.name
        ");

        Schema::dropIfExists('user_names');
    }

};

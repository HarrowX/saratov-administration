<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasColumn('personal_access_tokens', 'refresh_id')) {
            Schema::table('personal_access_tokens', static function (Blueprint $table) {
                $table->unsignedBigInteger('refresh_id')->nullable();
                $table->foreign('refresh_id')
                    ->on('personal_access_tokens')
                    ->references('id')
                ;
            });
        }
        if(!Schema::hasColumn('personal_access_tokens', 'created_ip')) {
            Schema::table('personal_access_tokens', static function (Blueprint $table) {
                $table->string('created_ip')->nullable();
            });
        }
        if(!Schema::hasColumn('personal_access_tokens', 'updated_ip')) {
            Schema::table('personal_access_tokens', static function (Blueprint $table) {
                $table->string('updated_ip')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('personal_access_tokens', 'refresh_id')) {
            Schema::table('personal_access_tokens', static function (Blueprint $table) {
                $table->dropConstrainedForeignId('refresh_id');
            });
        }
        if(Schema::hasColumn('personal_access_tokens', 'created_ip')) {
            Schema::table('personal_access_tokens', static function (Blueprint $table) {
                $table->dropConstrainedForeignId('created_ip');
            });
        }
        if(Schema::hasColumn('personal_access_tokens', 'updated_ip')) {
            Schema::table('personal_access_tokens', static function (Blueprint $table) {
                $table->dropConstrainedForeignId('updated_ip');
            });
        }
    }
};

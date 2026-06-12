<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->renameColumn('parking', 'has_parking');
            $table->renameColumn('accessibility', 'is_accessible');
        });
    }

    public function down(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->renameColumn('has_parking', 'parking');
            $table->renameColumn('is_accessible', 'accessibility');
        });
    }
};

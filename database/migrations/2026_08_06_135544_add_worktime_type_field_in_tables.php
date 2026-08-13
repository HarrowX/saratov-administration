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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->string('is_closed_by_default')->default(false);
            $table->timestamps();
        });

        Schema::table('attractions', function (Blueprint $table) {
            $table->foreignId('schedule_id')->nullable();
        });

//        Schema::create('schedule_record_kinds', function (Blueprint $table) {
//            $table->id();
//            $table->string('name');
//            $table->string('value');
//            $table->timestamps();
//        });


        Schema::create('schedule_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('schedule_id')->constrained('schedules');

            $table->string('kind');
            // like:
            // every-time (остальное null)
            // every-day (сетать только hour_start, hour_end)
            // week-day (сетать только hour_start, hour_end, week_start)
            // interval-week-day (сетать только hour_start, hour_end, week_start, week_end)
            // day (сетать только hour_start, hour_end, day_start)
            // interval-day (сетать только hour_start, hour_end, day_start)

            // приоритеты при вычислении: every-time < every-day < interval-week-day < week-day < interval-day < day

            $table->string('week_start')->nullable(); // like "1", "2", ..., "7" or "man", "thu", ... "sun". || заполняется при kind: week-day, interval-week-day
            $table->string('week_end')->nullable();   // like "1", "2", ..., "7" or "man", "thu", ... "sun". || заполняется при kind: interval-week-day

            $table->string('day_start')->nullable(); // like "30.12", "10.05", "09.05", "01.01" || заполняется при kind: day, interval-day
            $table->string('day_end')->nullable();   // like "30.12", "10.05", "09.05", "01.01" || заполняется при kind: interval-day

            $table->string('hour_start')->nullable(); // like "00:00", "12:00", "13::00", "24:00" || заполняется при kind: every-day, week-day, interval-week-day, day, interval-day
            $table->string('hour_end')->nullable();   // like "00:00", "12:00", "13::00", "24:00" || заполняется при kind: every-day, week-day, interval-week-day, day, interval-day

            $table->string('interval_type')->default('open'); // сложный комментарий
            $table->text('comment')->nullable(); //

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
//            $table->dropColumn('worktime_type');
//            $table->dropColumn('worktime_weekends');
            $table->dropColumn('schedule_id');
        });

        Schema::dropIfExists('schedule_records');
        Schema::dropIfExists('schedules');
    }
};

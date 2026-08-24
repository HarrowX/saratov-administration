<?php

use App\Enums\ScheduleRecordIntervalType;
use App\Enums\ScheduleRecordKind;
use App\Enums\ScheduleWeekDay;
use App\Models\Schedule;
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
            $table->morphs('schedulable');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_closed_by_default')->default(false);
            $table->timestamps();
        });

        Schema::create('schedule_records', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Schedule::class);

            $table->integer('order')->default(0);
            $table->integer('priority')->default(0);

            $table->enum('kind', ScheduleRecordKind::cases());
            // like:
            // every-time (остальное null)
            // every-day (сетать только hour_start, hour_end)
            // week-day (сетать только hour_start, hour_end, week_start)
            // interval-week-day (сетать только hour_start, hour_end, week_start, week_end)
            // day (сетать только hour_start, hour_end, day_start)
            // interval-day (сетать только hour_start, hour_end, day_start, day_end)

            $table->enum('week_start', ScheduleWeekDay::cases())->nullable(); // like "1", "2", ..., "7" || заполняется при kind: week-day, interval-week-day
            $table->enum('week_end', ScheduleWeekDay::cases())->nullable();   // like "1", "2", ..., "7" || заполняется при kind: interval-week-day

            $table->string('day_start')->nullable(); // like "30.12", "10.05", "09.05", "01.01" || заполняется при kind: day, interval-day
            $table->string('day_end')->nullable();   // like "30.12", "10.05", "09.05", "01.01" || заполняется при kind: interval-day

            $table->string('time_start')->nullable(); // like "00:00", "12:00", "13:00", "24:00" || заполняется при kind: every-day, week-day, interval-week-day, day, interval-day
            $table->string('time_end')->nullable();   // like "00:00", "12:00", "13:00", "24:00" || заполняется при kind: every-day, week-day, interval-week-day, day, interval-day

            $table->enum('interval_type', ScheduleRecordIntervalType::cases())->default(ScheduleRecordIntervalType::Open);
            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_records');
        Schema::dropIfExists('schedules');
    }
};

<?php

namespace App\Services;

use App\HasScheduleContract;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;

class ScheduleService
{
    /**
     * @var Schedule
     */
    public function isNowOpen(HasScheduleContract $schedulable): bool // todo need to model and in sql
    {
        $schedule = $schedulable->schedules()->where('is_active', true)->first();
        if (! $schedule) {
            return true;
        }

        // check exclude in formated  json

        return true;
    }

    public function useIsNowOpenFilter(Builder $builder) // todo need to model and in sql
    {
        $builder->whereHas('schedules', function (Builder $builder) {
            $builder
                ->where('is_active', true)
                ->whereHas('scheduleRecords', function (Builder $builder) {
                    $builder
                        ->orderBy('order')
                        ->where('');
                });
        });

        return true;
    }

    /**
     * @var Schedule
     */
    public function getFormatedJsonOnThisWeek(HasScheduleContract $schedulable): ?array
    {
        $schedule = $schedulable->schedules()->where('is_active', true)->first();
        if (! $schedule) {
            return null;
        }

        return [
            'mon' => 'working',
            'tue' => $this->getFormatedIntervalOnDay($schedule, 'tue'),
            'wed' => $this->getFormatedIntervalOnDay($schedule, 'wed'),
            'thu' => $this->getFormatedIntervalOnDay($schedule, 'thu'),
            'fri' => $this->getFormatedIntervalOnDay($schedule, 'fri'),
            'sat' => $this->getFormatedIntervalOnDay($schedule, 'sat'),
            'sun' => $this->getFormatedIntervalOnDay($schedule, 'sun'),
        ];
    }

    public function getFormatedIntervalOnDay(HasScheduleContract $schedulable, string $dayOfWeek): ?array
    {
        $schedule = $schedulable->schedules()->where('is_active', true)->first();
        if (! $schedule) {
            return null;
        }

        $records = $schedule->scheduleRecords()->orderBy('order')->get();

        // todo
        return [['8:00', '16:00', 'open'], ['16:00', '17:00', 'break'], ['17:00', '21:00', 'open']];
    }
}

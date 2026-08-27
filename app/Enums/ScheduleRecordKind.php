<?php

namespace App\Enums;

use App\Traits\HasOptions;

enum ScheduleRecordKind: string
{
    use HasOptions;

    case EveryTime = 'every-time';
    case EveryDay = 'every-day';
    case IntervalWeekDay = 'interval-week-day';
    case WeekDay = 'week-day';
    case IntervalDay = 'interval-day';
    case Day = 'day';

    public function getLabel(): string
    {
        return match ($this) {
            self::EveryTime => 'Круглосуточно',
            self::EveryDay => 'Ежедневно',
            self::IntervalWeekDay => 'Интервал дня недели',
            self::WeekDay => 'День недели',
            self::IntervalDay => 'Интервал дней',
            self::Day => 'День',
        };
    }
}

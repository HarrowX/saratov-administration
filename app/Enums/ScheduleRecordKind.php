<?php

namespace App\Enums;

enum ScheduleRecordKind: string
{
    case EveryTime = 'every-time';
    case EveryDay = 'every-day';
    case WeekDay = 'week-day';
    case InvervalWeekDay = 'interval-week-day';
    case Day = 'day';
    case IntervalDay = 'interval-day';
}

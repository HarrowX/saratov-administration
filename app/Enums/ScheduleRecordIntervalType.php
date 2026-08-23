<?php

namespace App\Enums;

enum ScheduleRecordIntervalType: string
{
    case Open = 'open';
    case Close = 'close';
    case Break = 'break';
    case DayOff = 'day-off';
}

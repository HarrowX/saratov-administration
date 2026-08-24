<?php

namespace App\Enums;

use App\Traits\HasOptions;

enum ScheduleRecordIntervalType: string
{
    use HasOptions;

    case Open = 'open';
    case Close = 'close';
    case Break = 'break';
    case DayOff = 'day-off';

    public function getLabel(): string
    {
        return match ($this) {
            self::Open => 'Открыто',
            self::Close => 'Закрыто',
            self::Break => 'Перерыв',
            self::DayOff => 'Выходной',
        };
    }
}

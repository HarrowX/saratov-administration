<?php

namespace App\Enums;

// согласованос с Carbon...->format('w') - week
use App\Traits\HasOptions;

enum ScheduleWeekDay: string
{
    use HasOptions;

    case Sunday = '0';
    case Monday = '1';
    case Tuesday = '2';
    case Wednesday = '3';
    case Thursday = '4';
    case Friday = '5';
    case Saturday = '6';

    public function getLabel(): string
    {
        return match ($this) {
            self::Sunday => 'Воскресенье',
            self::Monday => 'Понедельник',
            self::Tuesday => 'Вторник',
            self::Wednesday => 'Среда',
            self::Thursday => 'Четверг',
            self::Friday => 'Пятница',
            self::Saturday => 'Суббота',
        };
    }
}

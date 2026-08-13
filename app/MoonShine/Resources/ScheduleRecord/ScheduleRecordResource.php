<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ScheduleRecord;

use App\Models\ScheduleRecord;
use App\MoonShine\Resources\ScheduleRecord\Pages\ScheduleRecordDetailPage;
use App\MoonShine\Resources\ScheduleRecord\Pages\ScheduleRecordFormPage;
use App\MoonShine\Resources\ScheduleRecord\Pages\ScheduleRecordIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<ScheduleRecord, ScheduleRecordIndexPage, ScheduleRecordFormPage, ScheduleRecordDetailPage>
 */
class ScheduleRecordResource extends ModelResource
{
    protected string $model = ScheduleRecord::class;

    protected string $title = 'Записи расписаний';

    private array $kindOptions = [
        'every-time' => 'Круглосуточно',
        'every-day' => 'Ежедневно',
        'week-day' => 'День недели',
        'interval-week-day' => 'Интервал недели',
        'day' => 'День',
        'interval-day' => 'Интервал дней',
    ];

    private array $weekDaysOptions = [
        'mon' => 'Понедельник',
        'tue' => 'Вторник',
        'wed' => 'Среда',
        'thu' => 'Четверг',
        'fri' => 'Пятница',
        'sat' => 'Суббота',
        'sun' => 'Воскресенье',
    ];

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ScheduleRecordIndexPage::class,
            ScheduleRecordFormPage::class,
            ScheduleRecordDetailPage::class,
        ];
    }

    public function getKindOptions(): array
    {
        return $this->kindOptions;
    }

    public function getWeekDaysOptions(): array
    {
        return $this->weekDaysOptions;
    }
}

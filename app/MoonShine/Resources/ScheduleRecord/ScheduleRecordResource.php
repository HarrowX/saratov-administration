<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ScheduleRecord;

use App\Enums\ScheduleRecordIntervalType;
use App\Enums\ScheduleRecordKind;
use App\Enums\ScheduleWeekDay;
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
        return ScheduleRecordKind::options();
    }

    public function getWeekDaysOptions(): array
    {
        return ScheduleWeekDay::options();
    }

    public function getIntervalTypeOptions(): array
    {
        return ScheduleRecordIntervalType::options();
    }

    protected function search(): array
    {
        return [];
    }
}

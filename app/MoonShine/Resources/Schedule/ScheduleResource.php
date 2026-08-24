<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Schedule;

use App\Models\Schedule;
use App\MoonShine\Resources\Schedule\Pages\ScheduleDetailPage;
use App\MoonShine\Resources\Schedule\Pages\ScheduleFormPage;
use App\MoonShine\Resources\Schedule\Pages\ScheduleIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Schedule, ScheduleIndexPage, ScheduleFormPage, ScheduleDetailPage>
 */
class ScheduleResource extends ModelResource
{
    protected string $model = Schedule::class;

    protected string $title = 'Расписание';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ScheduleIndexPage::class,
            ScheduleFormPage::class,
            ScheduleDetailPage::class,
        ];
    }

    protected function search(): array
    {
        return ['id', 'name'];
    }
}

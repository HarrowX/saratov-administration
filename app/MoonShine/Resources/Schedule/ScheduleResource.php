<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Schedule;

use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;
use App\MoonShine\Resources\Schedule\Pages\ScheduleIndexPage;
use App\MoonShine\Resources\Schedule\Pages\ScheduleFormPage;
use App\MoonShine\Resources\Schedule\Pages\ScheduleDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Schedule, ScheduleIndexPage, ScheduleFormPage, ScheduleDetailPage>
 */
class ScheduleResource extends ModelResource
{
    protected string $model = Schedule::class;

    protected string $title = 'Schedules';
    
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
}

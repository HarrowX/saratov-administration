<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\EventCategory;

use Illuminate\Database\Eloquent\Model;
use App\Models\EventCategory;
use App\MoonShine\Resources\EventCategory\Pages\EventCategoryIndexPage;
use App\MoonShine\Resources\EventCategory\Pages\EventCategoryFormPage;
use App\MoonShine\Resources\EventCategory\Pages\EventCategoryDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<EventCategory, EventCategoryIndexPage, EventCategoryFormPage, EventCategoryDetailPage>
 */
class EventCategoryResource extends ModelResource
{
    protected string $model = EventCategory::class;

    protected string $title = 'Категории событий';

    protected string $column = 'name';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            EventCategoryIndexPage::class,
            EventCategoryFormPage::class,
            EventCategoryDetailPage::class,
        ];
    }
}

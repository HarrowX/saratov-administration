<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\EventCategory;

use App\Models\Category;
use App\MoonShine\Resources\EventCategory\Pages\EventCategoryDetailPage;
use App\MoonShine\Resources\EventCategory\Pages\EventCategoryFormPage;
use App\MoonShine\Resources\EventCategory\Pages\EventCategoryIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Category, EventCategoryIndexPage, EventCategoryFormPage, EventCategoryDetailPage>
 */
class EventCategoryResource extends ModelResource
{
    protected string $model = Category::class;

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

    protected function search(): array
    {
        return ['id', 'name'];
    }


}

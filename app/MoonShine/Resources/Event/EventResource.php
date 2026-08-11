<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Event;

use App\Models\Event;
use App\MoonShine\Resources\Event\Pages\EventDetailPage;
use App\MoonShine\Resources\Event\Pages\EventFormPage;
use App\MoonShine\Resources\Event\Pages\EventIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Event, EventIndexPage, EventFormPage, EventDetailPage>
 */
class EventResource extends ModelResource
{
    protected string $model = Event::class;

    protected string $title = 'События';

    protected string $column = 'name';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            EventIndexPage::class,
            EventFormPage::class,
            EventDetailPage::class,
        ];
    }

    protected function search(): array
    {
        return ['id', 'name', 'description', 'organizer_name', 'organizer_phone','organizer_email', 'organizer_website'];
    }


}

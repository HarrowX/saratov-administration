<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Event;

use App\Jobs\NotifyAllUsers;
use App\Models\Event;
use App\Models\User;
use App\MoonShine\Resources\Event\Pages\EventDetailPage;
use App\MoonShine\Resources\Event\Pages\EventFormPage;
use App\MoonShine\Resources\Event\Pages\EventIndexPage;
use App\Notifications\EventCreated;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
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
        return ['id', 'name', 'description', 'organizer_name', 'organizer_phone', 'organizer_email', 'organizer_website'];
    }

    protected function afterCreated(DataWrapperContract $item): DataWrapperContract
    {
        if (! $item->is_need_notify_all_users) {
            return $item;
        }

        dispatch(new NotifyAllUsers(new EventCreated($item->name, $item->start_date)));

        return $item;
    }
}

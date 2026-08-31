<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Event;

use App\Jobs\NotifyAllUsers;
use App\Jobs\NotifyFavoriteUsers;
use App\Models\CustomLocation;
use App\Models\Event;
use App\MoonShine\Resources\Event\Pages\EventDetailPage;
use App\MoonShine\Resources\Event\Pages\EventFormPage;
use App\MoonShine\Resources\Event\Pages\EventIndexPage;
use App\Notifications\EventCreated;
use App\Notifications\EventOnFavoriteCreated;
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
        if ($item->eventable && get_class($item->eventable) !== CustomLocation::class) {
            dispatch(new NotifyFavoriteUsers(new EventOnFavoriteCreated($item->name, $item->start_date, $item->eventable->name), $item->eventable));
        }
        if (request()->boolean('is_need_notify_all_users')) {
            dispatch(new NotifyAllUsers(new EventCreated($item->name, $item->start_date)));
        }

        return $item;
    }
}

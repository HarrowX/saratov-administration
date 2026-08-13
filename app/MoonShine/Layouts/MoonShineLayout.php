<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\Models\Attraction;
use App\Models\ContactUs;
use App\Models\CustomPoint;
use App\Models\Event;
use App\Models\Excursion;
use App\Models\GuidedTour;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\User;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Attraction\AttractionResource;
use App\MoonShine\Resources\ContactUs\ContactUsResource;
use App\MoonShine\Resources\CustomLocation\CustomLocationResource;
use App\MoonShine\Resources\CustomPoint\CustomPointResource;
use App\MoonShine\Resources\Event\EventResource;
use App\MoonShine\Resources\EventCategory\EventCategoryResource;
use App\MoonShine\Resources\Excursion\ExcursionResource;
use App\MoonShine\Resources\ExcursionPoint\ExcursionPointResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;
use App\MoonShine\Resources\Hotel\HotelResource;
use App\MoonShine\Resources\Restaurant\RestaurantResource;
use App\MoonShine\Resources\Schedule\ScheduleResource;
use App\MoonShine\Resources\ScheduleRecord\ScheduleRecordResource;
use App\MoonShine\Resources\User\UserResource;
use MoonShine\AssetManager\Raw;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\Layout\Div;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
            Raw::make('<script src="https://api-maps.yandex.ru/v3/?apikey='.config('app.admin.ymap_api_key').'&lang=ru_RU"></script>'),
        ];
    }

    protected function menu(): array
    {
        return [
            ...parent::menu(),
            MenuGroup::make('Места', [
                MenuItem::make(AttractionResource::class, 'Достопримечательности')
                    ->badge(fn () => Attraction::query()->count())
                    ->icon('building-library'),
                MenuItem::make(HotelResource::class, 'Отели')
                    ->badge(fn () => Hotel::query()->count())
                    ->icon('home-modern'),
                MenuItem::make(RestaurantResource::class, 'Заведения')
                    ->badge(fn () => Restaurant::query()->count())
                    ->icon('building-storefront'),
            ])->icon('map'),
            MenuItem::make(AttachmentResource::class, 'Прикрепляемое')->icon('paper-clip'),
            MenuItem::make(GuidedTourResource::class, 'Экскурсоводы')
                ->badge(fn () => GuidedTour::query()->count())
                ->icon('user-circle'),
            MenuGroup::make('События', [
                MenuItem::make(EventResource::class, 'События')->badge(fn () => Event::query()->count()),
                MenuItem::make(EventCategoryResource::class, 'Категории событий'),
                MenuItem::make(CustomLocationResource::class, 'Дополнительная локация'),
            ])->icon('calendar-days'),
            MenuGroup::make('Экскурсии', [
                MenuItem::make(ExcursionResource::class, 'Экскурсии')->badge(fn () => Excursion::query()->count()),
                MenuItem::make(ExcursionPointResource::class, 'Точки экскурсий'),
                MenuItem::make(CustomPointResource::class, 'Дополнительные точки экскурсий')->badge(fn () => CustomPoint::query()->count()),
            ])->icon('academic-cap'),
            MenuItem::make(ContactUsResource::class, 'Связаться с нами')->icon('envelope')->badge(fn () => ContactUs::query()->count()),
            MenuItem::make(UserResource::class, 'Пользователи')->icon('user')->badge(fn () => User::query()->count()),
            MenuGroup::make('Расписание', [
                MenuItem::make(ScheduleResource::class, 'Расписание'),
                MenuItem::make(ScheduleRecordResource::class, 'Записи Расписаний'),
            ])->icon('view-columns'),
        ];
    }

    #[Override]
    protected function getFooterCopyright(): string
    {
        return '';
    }

    #[Override]
    protected function getFooterMenu(): array
    {
        return [];
    }

    //    #[Override]
    //    protected function getSearchComponent(): ComponentContract
    //    {
    //        return Div::make();
    //    }

    /**
     * @param  ColorManager  $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }
}

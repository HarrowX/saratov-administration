<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Attraction\AttractionResource;
use App\MoonShine\Resources\CustomPoint\CustomPointResource;
use App\MoonShine\Resources\Event\EventResource;
use App\MoonShine\Resources\EventCategory\EventCategoryResource;
use App\MoonShine\Resources\Excursion\ExcursionResource;
use App\MoonShine\Resources\ExcursionPoint\ExcursionPointResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;
use App\MoonShine\Resources\Hotel\HotelResource;
use App\MoonShine\Resources\Restaurant\RestaurantResource;
use MoonShine\AssetManager\Raw;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\Layout\Div;
use App\MoonShine\Resources\CustomLocation\CustomLocationResource;

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
                MenuItem::make(AttractionResource::class, 'Достопримечательности')->icon('building-library'),
                MenuItem::make(HotelResource::class, 'Отели')->icon('home-modern'),
                MenuItem::make(RestaurantResource::class, 'Заведения')->icon('building-storefront'),
            ])->icon('map'),
            MenuItem::make(AttachmentResource::class, 'Прикрепляемое')->icon('paper-clip'),
            MenuItem::make(GuidedTourResource::class, 'Экскурсоводы')->icon('user-circle'),
            MenuGroup::make('События', [
                MenuItem::make(EventResource::class, 'События'),
                MenuItem::make(EventCategoryResource::class, 'Категории событий'),
                MenuItem::make(CustomLocationResource::class, 'Дополнительная локация'),
            ])->icon('calendar-days'),
            MenuItem::make(ExcursionResource::class, 'Экскурсии'),
            MenuItem::make(ExcursionPointResource::class, 'Точки экскурсий'),
            MenuItem::make(CustomPointResource::class, 'Дополнительные точки экскурсий'),
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

    // #[Override]
    protected function getSearchComponent(): ComponentContract
    {
        return Div::make();
    }

    /**
     * @param  ColorManager  $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }
}

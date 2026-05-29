<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\GrayPalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\UI\Components\Layout\Div;
use Override;
use App\MoonShine\Resources\Restaurant\RestaurantResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;
use App\MoonShine\Resources\Hotel\HotelResource;
use App\MoonShine\Resources\Attraction\AttractionResource;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = GrayPalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
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
        ];
    }

    #[Override]
    protected function getFooterCopyright(): string
    {
        return "";
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
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }
}

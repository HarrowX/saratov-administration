<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Crud\Components\Layout\Search;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\GrayPalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\UI\Components\Layout\Div;
use Override;
use App\MoonShine\Resources\Restaurant\RestaurantResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;

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
            MenuItem::make(RestaurantResource::class, 'Заведения'),
            MenuItem::make(AttachmentResource::class, 'Прикрепляемое'),
            MenuItem::make(GuidedTourResource::class, 'Экскурсоводы'),
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

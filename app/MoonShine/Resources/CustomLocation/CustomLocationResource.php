<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CustomLocation;

use App\Models\CustomLocation;
use App\MoonShine\Resources\CustomLocation\Pages\CustomLocationDetailPage;
use App\MoonShine\Resources\CustomLocation\Pages\CustomLocationFormPage;
use App\MoonShine\Resources\CustomLocation\Pages\CustomLocationIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<CustomLocation, CustomLocationIndexPage, CustomLocationFormPage, CustomLocationDetailPage>
 */
class CustomLocationResource extends ModelResource
{
    protected string $model = CustomLocation::class;

    protected string $title = 'Дополнительная локация';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            CustomLocationIndexPage::class,
            CustomLocationFormPage::class,
            CustomLocationDetailPage::class,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CustomLocation;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomLocation;
use App\MoonShine\Resources\CustomLocation\Pages\CustomLocationIndexPage;
use App\MoonShine\Resources\CustomLocation\Pages\CustomLocationFormPage;
use App\MoonShine\Resources\CustomLocation\Pages\CustomLocationDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

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

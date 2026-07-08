<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CustomPoint;

use App\Models\CustomPoint;
use App\MoonShine\Resources\CustomPoint\Pages\CustomPointDetailPage;
use App\MoonShine\Resources\CustomPoint\Pages\CustomPointFormPage;
use App\MoonShine\Resources\CustomPoint\Pages\CustomPointIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<CustomPoint, CustomPointIndexPage, CustomPointFormPage, CustomPointDetailPage>
 */
class CustomPointResource extends ModelResource
{
    protected string $model = CustomPoint::class;

    protected string $title = 'Дополнительная точка экскурсии';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            CustomPointIndexPage::class,
            CustomPointFormPage::class,
            CustomPointDetailPage::class,
        ];
    }
}

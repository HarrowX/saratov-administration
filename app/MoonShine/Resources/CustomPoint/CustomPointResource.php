<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CustomPoint;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomPoint;
use App\MoonShine\Resources\CustomPoint\Pages\CustomPointIndexPage;
use App\MoonShine\Resources\CustomPoint\Pages\CustomPointFormPage;
use App\MoonShine\Resources\CustomPoint\Pages\CustomPointDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<CustomPoint, CustomPointIndexPage, CustomPointFormPage, CustomPointDetailPage>
 */
class CustomPointResource extends ModelResource
{
    protected string $model = CustomPoint::class;

    protected string $title = 'CustomPoints';
    
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

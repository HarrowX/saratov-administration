<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ExcursionPoint;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExcursionPoint;
use App\MoonShine\Resources\ExcursionPoint\Pages\ExcursionPointIndexPage;
use App\MoonShine\Resources\ExcursionPoint\Pages\ExcursionPointFormPage;
use App\MoonShine\Resources\ExcursionPoint\Pages\ExcursionPointDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<ExcursionPoint, ExcursionPointIndexPage, ExcursionPointFormPage, ExcursionPointDetailPage>
 */
class ExcursionPointResource extends ModelResource
{
    protected string $model = ExcursionPoint::class;

    protected string $title = 'Точки экскурсии';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ExcursionPointIndexPage::class,
            ExcursionPointFormPage::class,
            ExcursionPointDetailPage::class,
        ];
    }
}

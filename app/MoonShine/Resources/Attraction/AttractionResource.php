<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Attraction;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attraction;
use App\MoonShine\Resources\Attraction\Pages\AttractionIndexPage;
use App\MoonShine\Resources\Attraction\Pages\AttractionFormPage;
use App\MoonShine\Resources\Attraction\Pages\AttractionDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Attraction, AttractionIndexPage, AttractionFormPage, AttractionDetailPage>
 */
class AttractionResource extends ModelResource
{
    protected string $model = Attraction::class;

    protected string $title = 'Достопремечательности';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            AttractionIndexPage::class,
            AttractionFormPage::class,
            AttractionDetailPage::class,
        ];
    }
}

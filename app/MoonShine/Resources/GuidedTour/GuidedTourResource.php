<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\GuidedTour;

use Illuminate\Database\Eloquent\Model;
use App\Models\GuidedTour;
use App\MoonShine\Resources\GuidedTour\Pages\GuidedTourIndexPage;
use App\MoonShine\Resources\GuidedTour\Pages\GuidedTourFormPage;
use App\MoonShine\Resources\GuidedTour\Pages\GuidedTourDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<GuidedTour, GuidedTourIndexPage, GuidedTourFormPage, GuidedTourDetailPage>
 */
class GuidedTourResource extends ModelResource
{
    protected string $model = GuidedTour::class;

    protected string $title = 'Экскурсоводы';
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            GuidedTourIndexPage::class,
            GuidedTourFormPage::class,
            GuidedTourDetailPage::class,
        ];
    }
}

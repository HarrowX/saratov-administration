<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Restaurant;

use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\MoonShine\Resources\Restaurant\Pages\RestaurantIndexPage;
use App\MoonShine\Resources\Restaurant\Pages\RestaurantFormPage;
use App\MoonShine\Resources\Restaurant\Pages\RestaurantDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Restaurant, RestaurantIndexPage, RestaurantFormPage, RestaurantDetailPage>
 */
class RestaurantResource extends ModelResource
{
    protected string $model = Restaurant::class;

    protected string $title = 'Заведения';
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            RestaurantIndexPage::class,
            RestaurantFormPage::class,
            RestaurantDetailPage::class,
        ];
    }
}

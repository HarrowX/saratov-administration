<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Hotel;

use App\Models\Hotel;
use App\MoonShine\Resources\Hotel\Pages\HotelDetailPage;
use App\MoonShine\Resources\Hotel\Pages\HotelFormPage;
use App\MoonShine\Resources\Hotel\Pages\HotelIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Hotel, HotelIndexPage, HotelFormPage, HotelDetailPage>
 */
class HotelResource extends ModelResource
{
    protected string $model = Hotel::class;

    protected string $title = 'Отели';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            HotelIndexPage::class,
            HotelFormPage::class,
            HotelDetailPage::class,
        ];
    }

    protected function search(): array
    {
        return ['id', 'name', 'description', 'second_description', 'address', 'phone', 'email', 'website'];
    }
}

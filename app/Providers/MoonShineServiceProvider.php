<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\Restaurant\RestaurantResource;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;
use App\MoonShine\Resources\Hotel\HotelResource;
use App\MoonShine\Pages\Attraction;
use App\MoonShine\Resources\Attraction\AttractionResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  CoreContract<MoonShineConfigurator>  $core
     */
    public function boot(CoreContract $core): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                RestaurantResource::class,
                AttachmentResource::class,
                GuidedTourResource::class,
                HotelResource::class,
                AttractionResource::class,
            ])
            ->pages([
                ...$core->getConfig()->getPages(),
                Attraction::class,
            ])
        ;
    }
}

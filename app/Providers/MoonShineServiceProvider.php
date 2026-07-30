<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Attraction\AttractionResource;
use App\MoonShine\Resources\ContactUs\ContactUsResource;
use App\MoonShine\Resources\CustomLocation\CustomLocationResource;
use App\MoonShine\Resources\CustomPoint\CustomPointResource;
use App\MoonShine\Resources\Event\EventResource;
use App\MoonShine\Resources\EventCategory\EventCategoryResource;
use App\MoonShine\Resources\Excursion\ExcursionResource;
use App\MoonShine\Resources\ExcursionPoint\ExcursionPointResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;
use App\MoonShine\Resources\Hotel\HotelResource;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\Restaurant\RestaurantResource;
use App\MoonShine\Resources\User\UserResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

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
                EventResource::class,
                EventCategoryResource::class,
                ExcursionResource::class,
                ExcursionPointResource::class,
                CustomPointResource::class,
                ContactUsResource::class,
                UserResource::class,
                CustomLocationResource::class,
            ])
            ->pages([
                ...$core->getConfig()->getPages(),
            ]);
    }
}

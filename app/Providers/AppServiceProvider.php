<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\FavoritableService;
use App\Services\PlaceVisitService;
use App\Services\UserService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\VKID\Provider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthService::class);
        $this->app->singleton(UserService::class);
        $this->app->singleton(FavoritableService::class);
        $this->app->singleton(PlaceVisitService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('vk', Provider::class);
        });
    }
}

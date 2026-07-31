<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\FavoritableService;
use App\Services\ModelConversationService;
use App\Services\PlaceVisitService;
use App\Services\SystemPromptDataService;
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
        $this->app->singleton(ModelConversationService::class, static function () {
            return new ModelConversationService(
                (int) config('ai.user_messages.max_length')
            );
        });
        $this->app->singleton(SystemPromptDataService::class, static function () {
            return new SystemPromptDataService(
                (int) config('ai.database_entries.ttl'),
            );
        });
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

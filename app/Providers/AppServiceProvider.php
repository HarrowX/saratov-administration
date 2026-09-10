<?php

namespace App\Providers;

use App\Listeners\DeleteExpiredFcmNotificationTokens;
use App\Services\AuthService;
use App\Services\FavoritableService;
use App\Services\FirebaseDeviceTokensService;
use App\Services\ModelConversationService;
use App\Services\PlaceVisitService;
use App\Services\SystemPromptDataService;
use App\Services\UserService;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
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

        $this->app->singleton(ModelConversationService::class);
        $this->app->when(ModelConversationService::class)
            ->needs('$maxUserMessageLength')
            ->give(static fn () => (int) config('ai.user_messages.max_length'));

        $this->app->singleton(SystemPromptDataService::class);
        $this->app->when(SystemPromptDataService::class)
            ->needs('$databaseEntriesTtl')
            ->give(static fn () => (int) config('ai.database_entries.ttl'));

        $this->app->singleton(FirebaseDeviceTokensService::class);

        $this->app->when([AuthService::class])
            ->needs('$firebaseDeviceTokensService')
            ->give(FirebaseDeviceTokensService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('vk', Provider::class);
        });

        Event::listen(NotificationFailed::class, DeleteExpiredFcmNotificationTokens::class);

        Gate::define('viewApiDocs', static function ($user) {
            return method_exists($user, 'isSuperUser') && $user->isSuperUser();
        });
    }
}

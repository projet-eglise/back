<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Src\Application\Authentication\Events\HasProfilePicture;
use Src\Application\Authentication\Events\PasswordRequestCreated;
use Src\Application\Authentication\Events\UserCreated;
use Src\Application\ChurchHumanRessources\Listeners\CreateChristianNotification;
use Src\Application\ChurchHumanRessources\Listeners\SaveProfilePictureNotification;
use Src\Application\Mailing\Listeners\SendPasswordRequestNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PasswordRequestCreated::class => [
            SendPasswordRequestNotification::class,
        ],
        UserCreated::class => [
            CreateChristianNotification::class,
        ],
        HasProfilePicture::class => [
            SaveProfilePictureNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

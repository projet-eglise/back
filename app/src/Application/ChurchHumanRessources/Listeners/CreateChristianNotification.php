<?php

namespace Src\Application\ChurchHumanRessources\Listeners;

use Src\Application\ChurchHumanRessources\CreateChristian;
use Src\Domain\Shared\Birthdate;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Firstname;
use Src\Domain\Shared\Lastname;
use Src\Domain\Shared\PhoneNumber;
use Src\Domain\Shared\Uuid;
use Src\Application\ChurchHumanRessources\Listeners\CreateChristianCommand;
use Src\Domain\ChurchHumanRessources\Christian\ProfilePicture;

class CreateChristianNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private CreateChristian $CreateChristian,
    ) {
    }

    /**
     * Handle the event.
     *
     * @param CreateChristianCommand $event
     * @return void
     */
    public function handle(CreateChristianCommand $event)
    {
        $this->CreateChristian->__invoke(
            new Uuid($event->uuid()),
            new Firstname($event->firstname()),
            new Lastname($event->lastname()),
            new Email($event->email()),
            new PhoneNumber($event->phone()),
            new Birthdate($event->birthdate()),
            new ProfilePicture($event->profilePicture()),
        );
    }
}

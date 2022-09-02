<?php

namespace Src\Application\ChurchHumanRessources\Listeners;

use Src\Application\ChurchHumanRessources\SaveProfilePicture;

class SaveProfilePictureNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private SaveProfilePicture $SaveProfilePicture,
    )
    {
    }

    /**
     * Handle the event.
     *
     * @param SaveProfilePictureCommand $event
     * @return void
     */
    public function handle(SaveProfilePictureCommand $event)
    {
        return $this->SaveProfilePicture->__invoke($event->file());
    }
}

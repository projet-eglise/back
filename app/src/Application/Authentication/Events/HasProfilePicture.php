<?php

namespace Src\Application\Authentication\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Src\Application\ChurchHumanRessources\Listeners\SaveProfilePictureCommand;
use Src\Domain\ChurchHumanRessources\Exceptions\InvalidProfileImageException;

class HasProfilePicture implements SaveProfilePictureCommand
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        private UploadedFile $file
    ) {
        if ($file->getSize() > 2000000)
            throw new InvalidProfileImageException();

        if ($file->getSize() == 0)
            throw new InvalidProfileImageException();

        if (
            !in_array(
                $file->getClientMimeType(),
                ['image/jpg', 'image/png', 'image/jpeg']
            )
            || @getimagesize($file->getPathName()) === false
        )
            throw new InvalidProfileImageException();
    }

    public function file(): UploadedFile
    {
        return $this->file;
    }
}

<?php

namespace Src\Application\ChurchHumanRessources\Listeners;

use Illuminate\Http\UploadedFile;

interface SaveProfilePictureCommand
{
    public function file(): UploadedFile;
}

<?php

namespace Src\Domain\ChurchHumanRessources\Repositories;

use Illuminate\Http\UploadedFile;

interface ProfilePictureRepository
{
    public function save(UploadedFile $file): string;
}
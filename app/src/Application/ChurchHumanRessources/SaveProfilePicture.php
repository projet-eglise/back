<?php

namespace Src\Application\ChurchHumanRessources;

use Illuminate\Http\UploadedFile;
use Src\Infrastructure\ChurchHumanRessources\Repositories\FilestackProfilePictureRepository;

class SaveProfilePicture
{
    public function __construct(
        private FilestackProfilePictureRepository $repository
    )
    {
    }

    public function __invoke(UploadedFile $file): string
    {
        return $this->repository->save($file);
    }
}

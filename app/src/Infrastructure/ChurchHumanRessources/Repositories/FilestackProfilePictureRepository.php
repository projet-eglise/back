<?php

namespace Src\Infrastructure\ChurchHumanRessources\Repositories;

use Illuminate\Http\UploadedFile;
use Src\Domain\ChurchHumanRessources\Repositories\ProfilePictureRepository;
use Filestack\FilestackClient;

final class FilestackProfilePictureRepository implements ProfilePictureRepository
{
    public function __construct()
    {
        $this->FilestackClient = new FilestackClient(config('app.Filestack.key'));
    }

    public function save(UploadedFile $file): string
    {
        if ('PRD' !== config('app.env') ?? '')
            return 'https://templates.designwizard.com/43cddf10-4af1-11e9-874a-f70add5407e2.jpg';

        $file = $this->FilestackClient->upload($file->getPathName());
        return $file->url();
    }
}

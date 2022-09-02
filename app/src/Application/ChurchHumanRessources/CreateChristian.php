<?php

namespace Src\Application\ChurchHumanRessources;

use Src\Domain\ChurchHumanRessources\Christian;
use Src\Domain\ChurchHumanRessources\Christian\ProfilePicture;
use Src\Domain\ChurchHumanRessources\Exceptions\ChristianAlreadyExistsException;
use Src\Domain\Shared\Birthdate;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Firstname;
use Src\Domain\Shared\Lastname;
use Src\Domain\Shared\PhoneNumber;
use Src\Domain\Shared\Uuid;
use Src\Infrastructure\ChurchHumanRessources\Repositories\EloquentChristianRepository;

class CreateChristian
{
    public function __construct(
        private EloquentChristianRepository $repository
    ) {
    }

    public function __invoke(
        Uuid $uuid,
        Firstname $firstname,
        Lastname $lastname,
        Email $email,
        PhoneNumber $phone,
        Birthdate $birthdate,
        ProfilePicture $profilePicture,
    ) {
        if ($this->repository->findByEmail($email) !== null)
            throw new ChristianAlreadyExistsException();

        $this->repository->create(new Christian(
            $uuid,
            $firstname,
            $lastname,
            $email,
            $phone,
            $birthdate,
            $profilePicture,
        ));
    }
}

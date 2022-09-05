<?php

namespace Src\Domain\ChurchHumanRessources\Church;

use Src\Domain\ChurchHumanRessources\Christian;
use Src\Domain\ChurchHumanRessources\Christian\ProfilePicture;
use Src\Domain\Shared\Birthdate;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Firstname;
use Src\Domain\Shared\Lastname;
use Src\Domain\Shared\PhoneNumber;
use Src\Domain\Shared\Uuid;

class MainAdministrator extends Christian
{
    public function __construct(
        Christian $christian,
    ) {
        parent::__construct(
            new Uuid($christian->uuid()),
            new Firstname($christian->firstname()),
            new Lastname($christian->lastname()),
            new Email($christian->email()),
            new PhoneNumber($christian->phone()),
            new Birthdate($christian->birthdate()),
            new ProfilePicture($christian->profilePicture()),
        );
    }
}

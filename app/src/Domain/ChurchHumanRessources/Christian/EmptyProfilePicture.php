<?php

namespace Src\Domain\ChurchHumanRessources\Christian;

use Src\Domain\Shared\ValueObject\StringValueObject;

class EmptyProfilePicture extends ProfilePicture
{
    public function __construct()
    {
        parent::__construct('');
    }
}

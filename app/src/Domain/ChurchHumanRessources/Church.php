<?php

namespace Src\Domain\ChurchHumanRessources;

use Src\Domain\ChurchHumanRessources\Church\Name;
use Src\Domain\ChurchHumanRessources\Church\Pastor;
use Src\Domain\Shared\Address;

class Church
{
    public function __construct(
        private Name $name,
        private Pastor $pastor,
        private Address $address
    ) {
    }

    public function name(): string
    {
        return $this->name->value();
    }
}

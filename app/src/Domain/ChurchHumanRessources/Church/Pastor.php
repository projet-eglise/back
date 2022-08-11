<?php

namespace Src\Domain\ChurchHumanRessources\Church;

use Src\Domain\ChurchHumanRessources\Christian;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Firstname;
use Src\Domain\Shared\Lastname;

class Pastor
{
    private Christian $christian;

    public function __construct(
        Firstname $firstname,
        Lastname $lastname,
        Email $email
    ) {
        $this->christian = new Christian(
            $firstname,
            $lastname,
            $email,
            new EmptyPhoneNumber(),
        );
    }

    public function firstname(): string
    {
        return $this->christian->firstname();
    }

    public function lastname(): string
    {
        return $this->christian->lastname();
    }

    public function fullname(): string
    {
        return $this->christian->fullname();
    }

    public function email(): string
    {
        return $this->christian->email();
    }
}

<?php

namespace Src\Domain\ChurchHumanRessources;

use Src\Domain\Shared\Email;
use Src\Domain\Shared\Firstname;
use Src\Domain\Shared\Lastname;
use Src\Domain\Shared\PhoneNumber;

class Christian
{
    public function __construct(
        private Firstname $firstname,
        private Lastname $lastname,
        private Email $email,
        private PhoneNumber $phoneNumber,
    ) {
    }

    public function firstname(): string
    {
        return ucfirst($this->firstname->value());
    }

    public function lastname(): string
    {
        return strtoupper($this->lastname->value());
    }

    public function fullname(): string
    {
        return "{$this->firstname()} {$this->lastname()}";
    }

    public function email(): string
    {
        return $this->email->value();
    }

    public function phoneNumber(): string
    {
        return $this->phoneNumber->value();
    }
}

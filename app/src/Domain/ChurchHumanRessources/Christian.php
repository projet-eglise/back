<?php

namespace Src\Domain\ChurchHumanRessources;

use Src\Domain\ChurchHumanRessources\Christian\ProfilePicture;
use Src\Domain\Shared\Birthdate;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Firstname;
use Src\Domain\Shared\Lastname;
use Src\Domain\Shared\PhoneNumber;
use Src\Domain\Shared\Uuid;

class Christian
{
    public function __construct(
        private Uuid $uuid,
        private Firstname $firstname,
        private Lastname $lastname,
        private Email $email,
        private PhoneNumber $phone,
        private Birthdate $birthdate,
        private ProfilePicture $profilePicture,
    ) {
    }

    public function uuid(): string
    {
        return $this->uuid->value();
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

    public function phone(): string
    {
        return $this->phone->value();
    }

    public function birthdate(): string
    {
        return $this->birthdate ->value();
    }

    public function profilePicture(): string
    {
        return $this->profilePicture ->value();
    }
}

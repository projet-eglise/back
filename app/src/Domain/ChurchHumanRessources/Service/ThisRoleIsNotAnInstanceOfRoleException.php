<?php

namespace Src\Domain\ChurchHumanRessources\Service;

use Src\Domain\Shared\Exceptions\HttpException;

class ThisRoleIsNotAnInstanceOfRoleException extends HttpException
{
    public function message(): string
    {
        return "This role isn't an instance of Role.";
    }

    public function code(): int
    {
        return 500;
    }
}

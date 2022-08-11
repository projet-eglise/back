<?php

namespace Src\Domain\ChurchHumanRessources\Service;

use Src\Domain\Shared\Exceptions\HttpException;

class ExistingRoleException extends HttpException
{
    public function message(): string
    {
        return "This role already exists.";
    }

    public function code(): int
    {
        return 500;
    }
}

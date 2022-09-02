<?php

namespace Src\Domain\ChurchHumanRessources\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class ChristianAlreadyExistsException extends HttpException
{
    public function message(): string
    {
        return "Christian already exists";
    }

    public function code(): int
    {
        return 409;
    }
}

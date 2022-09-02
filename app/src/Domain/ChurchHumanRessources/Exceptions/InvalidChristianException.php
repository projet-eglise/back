<?php

namespace Src\Domain\ChurchHumanRessources\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class InvalidChristianException extends HttpException
{
    public function message(): string
    {
        return "Invalid christian";
    }

    public function code(): int
    {
        return 422;
    }
}